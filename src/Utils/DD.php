<?php

namespace App\Utils;

class DD
{
    public static function sd(...$v)
    {
        echo json_encode($v);
        exit;
    }
}