<?php

namespace App\Services\DockerBuilder\Arguments;

class Rm extends DockerArgument
{
    public function ArgumentToString(): string
    {
        return '--rm';
    }
}