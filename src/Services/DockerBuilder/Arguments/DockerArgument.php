<?php

namespace App\Services\DockerBuilder\Arguments;

abstract class DockerArgument
{
    abstract function ArgumentToString(): string;
}