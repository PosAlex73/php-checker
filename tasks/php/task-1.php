<?php

require_once dirname(__DIR__).'/myapp/vendor/autoload.php';

%code_here%

\PHPUnit\Framework\assertEquals(123, $result);
\PHPUnit\Framework\assertTrue(is_int($result));

