<?php

namespace App\Services\DockerBuilder\Arguments;

class User extends DockerArgument
{
    public function __construct(public string $name)
    {

    }

    public function ArgumentToString(): string
    {
        return '-u ' . $this->name;
    }
}