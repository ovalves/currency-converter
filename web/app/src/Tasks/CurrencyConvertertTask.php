<?php

namespace App\Tasks;

use Exception;
use App\Services\CurrencyConvertService;
use ConvertModel;

class CurrencyConvertertTask
{
    public function run(string $code, float $value): array
    {
        try {
            $tax = (new ConvertModel)->getConvertTaxes();

            /**
             * @todo pegar a taxa de acordo com o valor de conversão
             */
            echo '<pre>';
            var_dump ($tax);
            die();
            return (new CurrencyConvertService())
                ->using($code)
                ->withTax($value)
                ->apply();
        } catch (Exception $e) {
            log_error($e);
            return false;
        }
    }
}
