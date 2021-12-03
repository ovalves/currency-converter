<?php

namespace App\Exceptions;

use Porto\Core\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class NotAuthorizedResourceException extends Exception
{
    protected $code = Response::HTTP_FORBIDDEN;
    protected $message = 'Você não está autorizado a solicitar este recurso.';
}
