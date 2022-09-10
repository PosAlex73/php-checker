<?php

namespace App\Services\DockerBuilder\Arguments;

class ReadOnlyArg extends DockerArgument
{
    public function ArgumentToString(): string
    {
        return '--read-only';
    }
}