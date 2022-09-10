<?php

namespace App\Services\DockerBuilder\Arguments;

class ContainerName extends DockerArgument
{
    public function __construct(public string $name)
    {

    }

    function ArgumentToString(): string
    {
        return '--name ' . $this->name;
    }
}