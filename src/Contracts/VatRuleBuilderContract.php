<?php

namespace Addeeandra\VatCalculator\Contracts;

interface VatRuleBuilderContract
{
    /**
     * Base (DPP) transformer.
     *
     * Example:
     * Indonesia has a base transform of 11/12 which converted to 'Nilai Lainnya'.
     *
     * So, the base transform that can be applied are:
     *
     *      $builder->base(11/12);
     *
     * Or using a closure:
     *
     *      $builder->base(fn (int|float $base) => $base * 11 / 12);
     *
     * No base transform applied by default or equal to $base * 1.
     *
     * @param \Closure|float|null $transform
     * @return self
     */
    public function base(\Closure|float|null $transform = null): self;

    /**
     * Set the rate (e.g. 11% => 11, 12% => 12) of the VAT.
     *
     * @param int|float $amount
     * @return self
     */
    public function rate(int|float $amount): self;

    /**
     * Parse array to build as VAT rule.
     *
     * @param array $data
     * @return self
     */
    public function parse(array $data): self;

    /**
     * @return AsVatRule
     */
    public function build(): AsVatRule;
}