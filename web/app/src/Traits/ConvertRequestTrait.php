<?php
/**
 * @copyright   2019 - Selene
 * @author      Vinicius Oliveira <vinicius_o.a@live.com>
 * @category    Micro Framework
 * @since       2019-10-12
 */

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
