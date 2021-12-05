<?php

namespace App\Actions;

use Exception;
use Selene\Request\Request;
use App\Traits\ConvertRequestTrait;
use App\Tasks\CurrencyConvertertTask;
use App\Exceptions\CurrencyConverterGeneralException;

class CurrencyConvertertAction
{
    use ConvertRequestTrait;

    public function run(Request $request): void
    {
        try {
            $data = $request->sanitize([
                'code',
                'value',
                'payment',
                'email',
            ]);

            if (empty($data)) {
                throw new CurrencyConverterGeneralException();
            }

            $code = $data['code'] ?? '';
            $value = (float) $data['value'] ?? 0;
            $payment = (int) $data['payment'] ?? null;

            $this->throwErrorForRequestedValue($value);
            $this->throwErrorForRequestedCode($code);
            $this->throwErrorForRequestedPayment($payment);

            $value = (new CurrencyConvertertTask)->run($code, $value);
            echo '<pre>';
            var_dump ($value);
            die();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
