<?php

namespace App\Http\Error;

class WrongData extends JsonError
{
    protected $error = 'Data is not course json data';
}