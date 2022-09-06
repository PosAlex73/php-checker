<?php

namespace App\Exceptions;

use Exception;

class BadValidatedCourseData extends Exception
{
    protected $message = 'Invalid course data';
}