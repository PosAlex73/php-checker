<?php

namespace App\Services;

use App\Courses\Course;
use App\Http\CourseResponse;
use App\Http\Error\CodeError;
use App\Services\DockerBuilder\Arguments\ContainerName;
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

class CourseChecker
{
    protected Filesystem $filesystem;
    protected DockerBuilderInterface $dockerBuilder;

    protected string $project_dir;
    protected string $volume_dir;
    protected string $full_file_name;
    protected string $file_name;
    protected string $uuid;
    protected string|array $result;
    protected string $code_here = '%code_here%';

    protected const PHP_COURSE_DIR = 'php-course';

    public function __construct(
        protected ParameterBagInterface $parameterBag,
        protected TaskLoaderInterface $taskLoader,
        DockerBuilderInterface $dockerBuilder,
    ){
        $this->filesystem = new Filesystem();
        $this->dockerBuilder = $dockerBuilder;
        $this->project_dir = $this->parameterBag->get('kernel.project_dir') . '/' . 'var/courses/';
        $this->volume_dir = $this->parameterBag->get('docker_container_directory');
    }

    public function createTaskFile(Course $course)
    {
        $this->uuid = Ulid::generate();
        $this->file_name = static::PHP_COURSE_DIR . '-' . $this->uuid . '.php';
        $this->full_file_name = $this->project_dir . $this->file_name;
        try {
            $this->filesystem->touch($this->full_file_name);
        } catch (\Throwable $e) {
            DD::dd($e->getMessage());
            return new CodeError();
        }
        $task_file_content = $this->taskLoader->getTaskFileContent($course->getTaskId());
        $content = str_replace($this->code_here, $course->getCode(), $task_file_content);
        file_put_contents($this->full_file_name, $content);
    }

    public function getTaskResult(string $container_type): CourseResponse
    {
        $this->dockerBuilder->setArguments(
            $container_type,
            $this->file_name,
//            fixme add user
//            new User('php_course'),
            new Rm(),
            new ReadOnlyArg(),
            new ContainerName('php_course_container_' . $this->uuid),
            new WorkingDir($this->volume_dir),
            new Volume($this->project_dir, $this->volume_dir)
        );

        $docker_command = $this->dockerBuilder->getDockerCommand();
        $docker_command = $docker_command->toString();
        exec($docker_command, $result);
        $this->filesystem->remove($this->full_file_name);
        DD::sd($docker_command);

        if (empty($result)) {
            return new CourseResponse('Task done', serialize($result), CourseResponse::SUCCESS);
        } else {
            return new CourseResponse('Task failed', serialize($result), CourseResponse::ERROR);
        }
    }
}
