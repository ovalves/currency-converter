<?php

namespace App\Exceptions;

use Porto\Core\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class NotImplementedException extends Exception
{
    protected $code = Response::HTTP_NOT_IMPLEMENTED;
    protected $message = 'Este método ainda não está implementado.';
}
