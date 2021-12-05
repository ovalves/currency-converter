<?php

namespace App\Tasks;

use Exception;
use PaymentModel;
use OrdersModel;
use App\Exceptions\PaymentMethodBuilderException;

class SaveOrderTask
{
    public function run(array $convertData, int $paymentType): array
    {
        try {
            $payment = (new PaymentModel)->getPaymentByType($paymentType);
            $payment = reset($payment);

            if (empty($payment->label)) {
                throw new PaymentMethodBuilderException();
            }

            /**
             * @todo Realizar a ordem de compra da conversão das moedas
             * @see aqui estamos apenas adicionando o label do tipo de pagamento
             */
            $convertData['payment'] = $payment->label;
            if ((new OrdersModel)->saveOrder($convertData)) {
                return $convertData;
            }

            throw new PaymentMethodBuilderException();
        } catch (Exception $e) {
            log_error($e);
            return [];
        }
    }
}
