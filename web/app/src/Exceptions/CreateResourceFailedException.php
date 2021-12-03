<?php

namespace App\Exceptions;

use Porto\Core\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class CreateResourceFailedException extends Exception
{
    protected $code = Response::HTTP_EXPECTATION_FAILED;
    protected $message = 'Falha ao criar o recurso solicitado.';
}
