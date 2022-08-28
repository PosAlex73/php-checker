<?php

namespace App\Http\Error;

class WrongJson extends JsonError
{
    protected $error = 'Data is not JSON';
}