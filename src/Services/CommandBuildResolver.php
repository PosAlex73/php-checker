<?php

namespace App\Services;

use App\Services\Strategy\DockerCommand;
use App\Services\Strategy\SystemCommand;

class CommandBuildResolver
{
    public const DOCKER = 'docker';
    public const SYSTEM = 'system';

    public function resolveCommandBuilder(string $type)
    {
        return match ($type) {
            static::DOCKER => DockerCommand::class,
            static::SYSTEM => SystemCommand::class,
            default => SystemCommand::class
        };
    }
}
