<?php

namespace App\Services;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class FileTaskLoader implements TaskLoaderInterface
{
    protected string $task_dir;
    protected string $file_task_begin = 'task-';

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->task_dir = $parameterBag->get('task_dir');
    }

    public function getTaskFileContent(int $task_id): string
    {
        return file_get_contents($this->task_dir . 'php' . '/' . $this->file_task_begin . $task_id . '.php');
    }
}