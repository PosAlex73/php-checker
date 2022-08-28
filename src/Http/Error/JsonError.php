<?php

namespace App\Http\Error;

abstract class JsonError
{
    protected $error = 'Wrong json';
    protected $error_code = 500;

    public function getErrorMessage(array $data = [])
    {
        return [
            'error' => $this->error,
            'code' => $this->error_code,
            'data' => $data
        ];
    }

    public function getCode()
    {
        return $this->error_code;
    }
}