<?php

namespace App\Services\DockerBuilder\Arguments;

class WorkingDir extends DockerArgument
{
    public function __construct(public string $working_dir)
    {

    }

    public function ArgumentToString(): string
    {
        return '-w ' . $this->working_dir;
    }
}