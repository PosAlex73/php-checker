<?php

namespace App\Services;

interface CommandBuilderInterface
{
    public function getCommand(): string;
}
