<?php

namespace App\Services;

interface ServiceInterface
{
    public function using(mixed $using): self;

    public function withTax(float $tax): self;

    public function withValue(float $value): self;

    public function apply();
}