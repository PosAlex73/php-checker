<?php

namespace App\Http\Error;

class Wrong extends Error
{
    protected $error = 'Data is not JSON';
}