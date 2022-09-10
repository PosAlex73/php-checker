<?php

namespace App\Services;

use App\Http\Error\CodeError;
use App\Services\DockerBuilder\Arguments\ContainerName;
use App\Services\DockerBuilder\Arguments\File;
use App\Services\DockerBuilder\Arguments\ReadOnlyArg;
use App\Services\DockerBuilder\Arguments\Rm;
use App\Services\DockerBuilder\Arguments\User;
use App\Services\DockerBuilder\Arguments\Volume;
use App\Services\DockerBuilder\Arguments\WorkingDir;
use App\Services\DockerBuilder\DockerBuilderInterface;
use App\Utils\DD;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Uid\Ulid;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class CourseChecker
{
    protected Filesystem $filesystem;
    protected DockerBuilderInterface $dockerBuilder;

    protected string $project_dir;
    protected string $volume_dir;
    protected string $full_file_name;
    protected string $file_name;
    protected string $file_start_string = "<?php \n";
    protected string $uuid;

    protected const PHP_COURSE_DIR = 'php-course';

    public function __construct(protected ParameterBagInterface $parameterBag, DockerBuilderInterface $dockerBuilder)
    {
        $this->filesystem = new Filesystem();
        $this->dockerBuilder = $dockerBuilder;
        $this->project_dir = $this->parameterBag->get('kernel.project_dir') . '/' . 'var/courses/';
        $this->volume_dir = $this->parameterBag->get('docker_container_directory');
    }

    public function createTaskFile(string $code)
    {
        $this->uuid = Ulid::generate();
        $this->file_name = static::PHP_COURSE_DIR . '-' . $this->uuid . '.php';
        $this->full_file_name = $this->project_dir . $this->file_name;

        try {
            $this->filesystem->touch($this->full_file_name);
        } catch (\Throwable $e) {
            return new CodeError();
        }

        $content = $this->file_start_string . $code;
        file_put_contents($this->full_file_name, $content);
    }

    public function checkTask(string $container_type)
    {
        $this->dockerBuilder->setArguments(
            $container_type,
            new File($this->file_name),
            new User('php_course'),
            new Rm(),
            new ReadOnlyArg(),
            new ContainerName('php_course_container_' . $this->uuid),
            new WorkingDir($this->volume_dir),
            new Volume($this->project_dir, $this->volume_dir)
        );

        $docker_command = $this->dockerBuilder->getDockerCommand();
        $docker_command = $docker_command->toString();

        DD::dd($docker_command);

        exec($docker_command, $result);
        $this->filesystem->remove($this->full_file_name);
        DD::dd($result);
//        $docker_command = "docker run --rm --name php-run -u test -v {$this->project_dir}:/usr/src/myapp -w /usr/src/myapp php:7.4-cli php {$this->file_name} --read-only";

    }
}