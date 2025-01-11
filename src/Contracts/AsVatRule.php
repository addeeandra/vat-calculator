<?php

namespace Addeeandra\VatCalculator\Contracts;

interface AsVatRule
{
    /**
     * Base (DPP) transformer.
     *
     * Example:
     * Indonesia has a base transform of 11/12 which converted to 'Nilai Lainnya'.
     *
     * So, the base transform that can be applied are:
     *
     *      $rule->setBase(11/12);
     *
     * Or using a closure:
     *
     *      $rule->setBase(fn (int|float $base) => $base * 11 / 12);
     *
     * @param \Closure|float|null $transform
     * @return self
     */
    public function setBase(\Closure|float|null $transform = null): self;

    public function getBase(): \Closure|float|null;

    /**
     * Should between 0.0 and 1.0
     *
     * @param int|float $rate
     * @return self
     */
    public function setRate(int|float $rate): self;

    public function getRate(): int|float;

    /**
     * Calculate VAT based on the given price.
     *
     * @param int|float $amount
     * @return int|float
     */
    public function calculate(int|float $amount): int|float;

    public function calculator(): AsVatCalculator;

}