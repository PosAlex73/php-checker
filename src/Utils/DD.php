<?php

namespace App\Utils;

class DD
{
    public static function sd(...$v)
    {
        echo json_encode($v);
        exit;
    }

    public static function dd(...$v)
    {
        var_dump($v);
        exit();
    }
}