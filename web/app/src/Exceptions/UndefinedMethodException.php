<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class UndefinedMethodException extends Exception
{
    protected $code = SymfonyResponse::HTTP_FORBIDDEN;
    protected $message = 'Verbo http indefinido!';
}
