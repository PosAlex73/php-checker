<?php

namespace App\Services\DockerBuilder\Commands;

use App\Services\DockerBuilder\Arguments\DockerArgument;

class DockerCommand
{
    protected array $arguments;
    protected string $docker_run = 'docker run ';

    public function __construct(DockerArgument ...$arguments)
    {
        $this->arguments = $arguments;
    }

    public function toString(): string
    {
        /** @var DockerArgument $argument */
        foreach ($this->arguments as $argument) {
            $docker_arguments[] = $argument->ArgumentToString();
        }

        return $this->docker_run . join(' ', $docker_arguments);
    }
}