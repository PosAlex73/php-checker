<?php

namespace App\Services;

interface TaskLoaderInterface
{
    public function getTaskFileContent(int $task_id): string|null;
}