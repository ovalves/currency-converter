<?php

use Selene\Model\ModelAbstract;
use Selene\Drivers\MongoDB\MongoDriver;

class OrdersModel extends ModelAbstract
{
    /**
     * Constante que indica o nome da tabela
     */
    const TABLENAME = 'orders';

    /**
     * @todo adicionar os filtros por usuário e ordem
     *
     * Retorna as ordens do histórico
     */
    public function findOrder(int $userId, string $orderID) : array
    {
        try {
            return (new MongoDriver)
                // ->filters(['type' => $type])
                ->query('orders')
                ->toArray();
        } catch (\Throwable $th) {
            log_error($th);
            throw $th;
        }
    }

    /**
     * Retorna o pagamento por seu tipo
     */
    public function saveOrder(array $order) : bool
    {
        try {
            (new MongoDriver)->insert('orders', $order);
            return true;
        } catch (\Throwable $th) {
            log_error($th);
            throw $th;
        }
    }
}
