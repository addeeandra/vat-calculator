<?php

namespace Addeeandra\VatCalculator\Builders;

use Addeeandra\VatCalculator\Contracts\AsVatRule;
use Addeeandra\VatCalculator\Contracts\VatRuleBuilderContract;
use Addeeandra\VatCalculator\Traits\VatRuleTrait;

class VatRuleBuilder implements VatRuleBuilderContract
{
    protected float|int|\Closure $base = 1;

    protected float|int $rate = 0;

    public function base(float|int|\Closure|null $transform = null): VatRuleBuilderContract
    {
        $this->base = $transform;

        return $this;
    }

    public function rate(float|int $amount): VatRuleBuilderContract
    {
        $this->rate = $amount;

        return $this;
    }

    /**
     * Require 'base' and 'rate'
     *
     * @throws \Throwable
     */
    public function parse(array $data): VatRuleBuilderContract
    {
        throw_if(data_get($data, 'base') === null, new \InvalidArgumentException('Base is required.'));
        throw_if(data_get($data, 'rate') === null, new \InvalidArgumentException('Rate is required.'));

        return $this;
    }

    public function build(): AsVatRule
    {
        return new class($this->base, $this->rate) implements AsVatRule {

            use VatRuleTrait;

            public function __construct(float|int|\Closure $base, float|int $rate)
            {
                $this->setBase($base);
                $this->setRate($rate);
            }

        };
    }

    public static function make(): VatRuleBuilderContract
    {
        return new static();
    }
}