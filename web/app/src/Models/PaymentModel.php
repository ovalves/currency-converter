<?php
/**
 * @copyright   2019 - Selene
 * @author      Vinicius Oliveira <vinicius_o.a@live.com>
 * @category    Micro Framework
 * @since       2019-10-12
 */

use Selene\Model\ModelAbstract;
use App\Services\MongoDBService;

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
        return (new MongoDBService)->query('payment')->toArray();
    }

    /**
     * Retorna se o tipo de pagamento requerido é valido
     */
    public function isValidPayment(int $payment) : bool
    {
        return (new MongoDBService)
                    ->filters(['type' => $payment])
                    ->options([
                        'projection' => [
                            '_id' => 0
                        ],
                    ])
                    ->query('payment')
                    ->isValid();
    }
}
