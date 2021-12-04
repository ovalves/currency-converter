<?php

namespace App\Traits;

use ConvertModel;
use PaymentModel;
use App\Exceptions\PaymentException;
use App\Exceptions\ConvertCodeException;
use App\Exceptions\ValueOutOfRangeException;

trait ConvertRequestTrait
{
    public function throwErrorForRequestedValue(float $value): void
    {
        /**
         * @todo Pegar os dados MIN_VALUE_CONSTRAINT e MAX_VALUE_CONSTRAINT da config do mongo DB
         */
        if ($value < ConvertModel::MIN_VALUE_CONSTRAINT || $value > ConvertModel::MAX_VALUE_CONSTRAINT) {
            throw new ValueOutOfRangeException();
        }
    }

    public function throwErrorForRequestedCode(string $code): void
    {
        if (false === (new ConvertModel)->isValidCode($code)) {
            throw new ConvertCodeException();
        };
    }

    public function throwErrorForRequestedPayment(int $payment): void
    {
        if (false == (new PaymentModel)->isValidPayment($payment)) {
            throw new PaymentException();
        };
    }
}
