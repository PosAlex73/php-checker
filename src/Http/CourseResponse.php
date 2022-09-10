<?php

namespace App\Http;

class CourseResponse
{
    public const SUCCESS = 200;
    public const ERROR = 500;

    public function __construct(protected string $message, protected string $result, protected int $code){}

    public function toArray()
    {
        return [
            'code' => $this->code,
            'message' => $this->message,
            'result' => $this->result
        ];
    }
}