<?php

namespace Addeeandra\VatCalculator;

use Addeeandra\VatCalculator\Contracts\AsVatCalculator;
use Addeeandra\VatCalculator\Contracts\AsVatRule;

class VatCalculator implements AsVatCalculator
{
    protected int|float $realRate;

    public function __construct(protected AsVatRule $rule)
    {
        if (
            (is_int($this->rule->getBase()) && $this->rule->getBase() == 1) ||
            (is_float($this->rule->getBase()) && $this->rule->getBase() == 1.0) ||
            (is_callable($this->rule->getBase()) && $this->rule->getBase()(1.0) == 1.0)
        ) {
            $this->realRate = $this->rule->getRate();
        } else {
            $this->realRate = $this->rule->calculate(100);
        }
    }

    public function rule(): AsVatRule
    {
        return $this->rule;
    }

    public function vatOfAmount(float|int $amountExcludedVat): float|int
    {
        return $this->rule->calculate($amountExcludedVat);
    }

    public function vatInAmount(float|int $amountIncludedVat): float|int
    {
        return $amountIncludedVat * ($this->realRate) / (100.0 + $this->realRate);
    }

    public function amountWithVat(float|int $amountExcludedVat): float|int
    {
        return $amountExcludedVat + $this->rule->calculate($amountExcludedVat);
    }

    public function amountWithoutVat(float|int $amountIncludedVat): float|int
    {
        return $amountIncludedVat * 100.0 / (100.0 + $this->realRate);
    }
}