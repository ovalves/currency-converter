<?php

namespace App\Exceptions;

use Exception;
use Porto\Core\Abstracts\Transformers\Transformer;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class InvalidTransformerException extends Exception
{
    protected $code = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;
    protected $message = 'As classes do tipo Transformers vem extender a classe '.Transformer::class.'.';
}
