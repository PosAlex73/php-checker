<?php

namespace App\Services\DockerBuilder\Commands;

class RunPhpContainer extends DockerCommand
{
    protected string $command = 'php:7.4-cli php';
}