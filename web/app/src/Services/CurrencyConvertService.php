<?php

namespace App\Services;

use Exception;
use Selene\Http\Client;
use App\Exceptions\CurrencyConvertException;

final class CurrencyConvertService implements ServiceInterface
{
    private mixed $using;
    private float $tax;

    public function using(mixed $using): self
    {
        $this->using = $using;
        return $this;
    }

    public function withTax(float $tax): self
    {
        $this->tax = $tax;
        return $this;
    }

    public function apply(): array
    {
        try {
            echo '<pre>';
            var_dump ($this->using);
            var_dump ($this->tax);
            die();
            $request = (new Client('https://economia.awesomeapi.com.br'))->request(Client::GET, "/json/last/BRL-{$this->using}");

            if ($request->hasError()) {
                throw new CurrencyConvertException();
            }

            return $request->asArray();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
