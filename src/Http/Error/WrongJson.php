<?php

namespace App\Http\Error;

class WrongJson
{
    public const WRONG_JSON = 'Wrong json';

    public static function JsonMessage()
    {
        return json_encode(static::WRONG_JSON);
    }
}