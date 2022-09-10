<?php

namespace App\Services\DockerBuilder\Arguments;

class File extends DockerArgument
{
    public function __construct(public string $file)
    {

    }

    public function ArgumentToString(): string
    {
        return $this->file;
    }
}