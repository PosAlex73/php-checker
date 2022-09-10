<?php

namespace App\Services\DockerBuilder;

use App\Services\DockerBuilder\Arguments\DockerArgument;
use App\Services\DockerBuilder\Commands\DockerCommand;
use App\Services\DockerBuilder\Commands\RunPhpContainer;
use App\Services\DockerBuilder\Commands\RunPythonContainer;

class DockerBuilder implements DockerBuilderInterface
{
    protected array $arguments;
    protected string $container_type;

    public function setArguments(string $container_type, DockerArgument ...$arguments)
    {
        $this->container_type = $container_type;
        $this->arguments = $arguments;
    }

    public function getDockerCommand(): DockerCommand
    {
        $type = $this->getContainerType();

        return new $type(...$this->arguments);
    }

    protected function getContainerType(): string
    {
        return match ($this->container_type) {
            'php' => RunPhpContainer::class,
            'python' => RunPythonContainer::class
        };
    }
}