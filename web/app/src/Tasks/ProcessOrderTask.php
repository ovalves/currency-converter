<?php

namespace App\Tasks;

use Exception;
use App\Exceptions\PaymentMethodBuilderException;

class ProcessOrderTask
{
    public function run(array $convertData, float $value): array
    {
        try {
            if (empty($convertData['tax'])) {
                throw new PaymentMethodBuilderException();
            }

            /**
             * @todo Realizar a ordem de compra da conversão das moedas
             * @see aqui estamos apenas calculando o valor das taxas da compra
             */
            $totalTax = array_sum($convertData['tax']);
            $convertData['order_value'] = $value - $totalTax;
            $convertData['total_tax'] = $totalTax;
            return $convertData;
        } catch (Exception $e) {
            log_error($e);
            return [];
        }
    }
}
