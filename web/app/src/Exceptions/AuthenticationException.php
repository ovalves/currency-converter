<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationException extends Exception
{
    protected $code = Response::HTTP_UNAUTHORIZED;
    protected $message = 'Um erro ocorreu ao tentar autenticar o usuário.';
}
