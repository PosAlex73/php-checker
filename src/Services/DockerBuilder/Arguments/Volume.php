<?php

namespace App\Services\DockerBuilder\Arguments;

class Volume extends DockerArgument
{
    public function __construct(public string $root_directory, public string $volume)
    {

    }

    public function ArgumentToString(): string
    {
        return '-v ' . $this->root_directory . ':' . $this->volume;
    }
}