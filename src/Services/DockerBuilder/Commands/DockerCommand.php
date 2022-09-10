<?php

namespace App\Services\DockerBuilder\Commands;

use App\Services\DockerBuilder\Arguments\DockerArgument;

abstract class DockerCommand
{
    protected array $arguments;
    protected string $file;
    protected string $docker_run = 'docker run ';

    public function __construct(string $file, DockerArgument ...$arguments)
    {
        $this->arguments = $arguments;
        $this->file = $file;
    }

    public function toString(): string
    {
        /** @var DockerArgument $argument */
        foreach ($this->arguments as $argument) {
            $docker_arguments[] = $argument->ArgumentToString();
        }

        return $this->docker_run . ' ' . join(' ', $docker_arguments) . ' ' . $this->command . ' ' . $this->file;
    }
}