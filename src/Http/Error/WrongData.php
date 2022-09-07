<?php

namespace App\Http\Error;

class WrongData extends Error
{
    protected $error = 'Data is not course json data';
}