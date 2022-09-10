<?php

namespace App\Services\DockerBuilder\Commands;

class RunPhpContainer extends DockerCommand
{
    protected string $docker_run = 'docker run php:7.4-cli php';
}