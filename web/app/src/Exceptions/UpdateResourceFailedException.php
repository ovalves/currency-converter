<?php

namespace App\Exceptions;

use Porto\Core\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class UpdateResourceFailedException extends Exception
{
    protected $code = Response::HTTP_EXPECTATION_FAILED;
    protected $message = 'Falha ao atualizar o recurso.';
}
