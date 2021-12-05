<?php
/**
 * @copyright   2019 - Selene
 * @author      Vinicius Oliveira <vinicius_o.a@live.com>
 * @category    Micro Framework
 * @since       2019-10-12
 */

use Selene\Model\ModelAbstract;
use Selene\Drivers\MongoDB\MongoDriver;

class PaymentModel extends ModelAbstract
{
    /**
     * Constante que indica o nome da tabela
     */
    const TABLENAME = 'payment';

    /**
     * Retorna os tipos de pagamentos e sua taxa de custo
     *
     * @return void
     */
    public function getMethods()
    {
        return (new MongoDriver)->query('payment')->toArray();
    }

    /**
     * Retorna o pagamento por seu tipo
     */
    public function getPaymentByType(int $type) : array
    {
        return (new MongoDriver)
                    ->filters(['type' => $type])
                    ->options([
                        'projection' => [
                            '_id' => 0
                        ],
                    ])
                    ->query('payment')
                    ->toArray();
    }

    /**
     * Retorna se o tipo de pagamento requerido é valido
     */
    public function isValidPayment(int $type) : bool
    {
        return (new MongoDriver)
                    ->filters(['type' => $type])
                    ->options([
                        'projection' => [
                            '_id' => 0
                        ],
                    ])
                    ->query('payment')
                    ->isValid();
    }
}
