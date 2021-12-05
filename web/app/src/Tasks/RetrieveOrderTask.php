<?php

namespace App\Tasks;

use Exception;
use OrdersModel;

class RetrieveOrderTask
{
    public function run(int $userId, string $orderID): array
    {
        try {
            return (new OrdersModel)->findOrder($userId, $orderID);
        } catch (Exception $e) {
            log_error($e);
            return [];
        }
    }
}
