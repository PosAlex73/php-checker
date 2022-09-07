<?php

namespace App\Services;

use App\Http\Error\CodeError;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Uid\Ulid;

class CourseChecker
{
    protected Filesystem $filesystem;
    protected string $project_dir;

    protected const PHP_COURSE_DIR = 'php-course';

    public function __construct(protected ParameterBagInterface $parameterBag)
    {
        $this->filesystem = new Filesystem();
        $this->project_dir = $this->parameterBag->get('kernel.project_dir') . '/' . 'var/courses/';
    }

    public function createTaskFile(string $code)
    {
        $file_name = $this->project_dir . static::PHP_COURSE_DIR . Ulid::generate();

        try {
            $this->filesystem->touch($file_name);
        } catch (\Throwable $e) {
            return new CodeError();
        }

        return $file_name;
    }

    public function checkTask()
    {

    }
}