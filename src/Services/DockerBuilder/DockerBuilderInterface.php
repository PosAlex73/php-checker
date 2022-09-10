<?php

namespace App\Services\DockerBuilder;

use App\Services\DockerBuilder\Commands\DockerCommand;

interface DockerBuilderInterface
{
    function getDockerCommand(): DockerCommand;
}