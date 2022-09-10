<?php

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

%code_here%

\PHPUnit\Framework\assertEquals(123, $result);
\PHPUnit\Framework\assertTrue(is_int($result));

