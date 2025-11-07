<?php

namespace App\Exceptions;

use App\Traits\RenderToJson;
use Exception;

class InvalidTokenException extends Exception
{
    use RenderToJson;
    protected $message = 'The provided token is invalid or has expired.';
    protected $code = 400;
}
