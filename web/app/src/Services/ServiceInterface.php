<?php

namespace App\Services;

interface ServiceInterface
{
    public function using(mixed $using): self;

    public function withTax(float $value): self;

    public function apply();
}