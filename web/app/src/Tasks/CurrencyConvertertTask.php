<?php

namespace App\Tasks;

use Exception;

class CurrencyConvertertTask
{
    public function create(array $data): bool
    {
        try {
            // Do Something
        } catch (Exception $e) {
            log_error($e);
            return false;
        }
    }
}
