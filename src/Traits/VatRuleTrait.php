<?php

namespace Addeeandra\VatCalculator\Traits;

use Addeeandra\VatCalculator\Contracts\AsVatCalculator;
use Addeeandra\VatCalculator\Contracts\AsVatRule;
use Addeeandra\VatCalculator\VatCalculator;

trait VatRuleTrait
{
    protected float|int|\Closure $base;

    protected float|int $rate;

    public function setBase(float|\Closure|null $transform = null): AsVatRule
    {
        $this->base = $transform;

        return $this;
    }

    public function getBase(): float|\Closure|null
    {
        return $this->base;
    }

    public function setRate(float|int $rate): AsVatRule
    {
        $this->rate = $rate;

        return $this;
    }

    public function getRate(): float|int
    {
        return $this->rate;
    }

    public function calculate(float|int $amount): int|float
    {
        $base = $this->base instanceof \Closure ? ($this->base)($amount) : $amount;

        return $base * $this->rate / 100.0;
    }

    public function calculator(): AsVatCalculator
    {
        return new VatCalculator($this);
    }
}