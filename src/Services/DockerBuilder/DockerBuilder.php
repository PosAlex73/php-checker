<?php

namespace App\Services\DockerBuilder;

use App\Services\DockerBuilder\Arguments\DockerArgument;
use App\Services\DockerBuilder\Commands\DockerCommand;

class DockerBuilder implements DockerBuilderInterface
{
    protected string $user = 'course_user_';
    protected array $arguments;

    public function setArguments(DockerArgument ...$arguments)
    {
        $this->arguments = $arguments;
    }

    public function getDockerCommand(): DockerCommand
    {
        return new DockerCommand(...$this->arguments);
    }
}