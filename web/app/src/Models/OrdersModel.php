<?php

use Selene\Model\ModelAbstract;
use App\Services\MongoDBService;

class OrdersModel extends ModelAbstract
{
    /**
     * Constante que indica o nome da tabela
     */
    const TABLENAME = 'orders';

    /**
     * Retorna o pagamento por seu tipo
     */
    public function saveOrder(array $order) : bool
    {
        try {
            (new MongoDBService)->insert('orders', $order);
            return true;
        } catch (\Throwable $th) {
            log_error($th);
            throw $th;
        }
    }
}
