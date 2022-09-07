<?php

namespace App\Http\Error;

class CodeError extends Error
{
    protected $error = 'Error while file creating or code executing';
}