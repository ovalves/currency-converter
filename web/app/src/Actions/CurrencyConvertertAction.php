<?php

namespace App\Actions;

use Exception;
use Selene\Request\Request;
use App\Traits\ConvertRequestTrait;
use App\Exceptions\CurrencyConverterGeneralException;

class CurrencyConvertertAction
{
    use ConvertRequestTrait;

    public function run(Request $request): void
    {
        try {
            $sanitizedData = $request->sanitizeInput([
                'contrato',
                'contrato.token',
            ]);

            echo '<pre>';
            var_dump($sanitizedData);
            var_dump($request);
            die();

            $params = $request->getQueryParams();

            if (empty($params)) {
                throw new CurrencyConverterGeneralException();
            }

            $value = (float) $params['value'] ?? 0;
            $payment = (int) $params['payment'] ?? null;
            $code = $params['code'] ?? '';

            $this->throwErrorForRequestedValue($value);
            $this->throwErrorForRequestedCode($code);
            $this->throwErrorForRequestedPayment($payment);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
