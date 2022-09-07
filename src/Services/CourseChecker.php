<?php

namespace App\Services;

use App\Http\Error\CodeError;
use App\Utils\DD;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Uid\Ulid;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class CourseChecker
{
    protected Filesystem $filesystem;
    protected string $project_dir;
    protected string $full_file_name;
    protected string $file_name;
    protected string $file_start_string = "<?php \n";

    protected const PHP_COURSE_DIR = 'php-course';

    public function __construct(protected ParameterBagInterface $parameterBag)
    {
        $this->filesystem = new Filesystem();
        $this->project_dir = $this->parameterBag->get('kernel.project_dir') . '/' . 'var/courses/';
    }

    public function createTaskFile(string $code)
    {
        $this->file_name = static::PHP_COURSE_DIR . '-' . Ulid::generate() . '.php';
        $this->full_file_name = $this->project_dir . $this->file_name;

        try {
            $this->filesystem->touch($this->full_file_name);
        } catch (\Throwable $e) {
            return new CodeError();
        }

        $content = $this->file_start_string . $code;
        file_put_contents($this->full_file_name, $content);
    }

    public function checkTask()
    {
        $docker_command = "docker run --rm --name php-run -v {$this->project_dir}:/usr/src/myapp -w /usr/src/myapp php:7.4-cli php {$this->file_name}";
        exec($docker_command, $result);
        $this->filesystem->remove($this->full_file_name);
        DD::dd($result);
    }
}