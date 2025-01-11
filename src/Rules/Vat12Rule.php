<?php

namespace Addeeandra\VatCalculator\Rules;

use Addeeandra\VatCalculator\Contracts\AsVatRule;
use Addeeandra\VatCalculator\Traits\VatRuleTrait;

class Vat12Rule implements AsVatRule
{
    use VatRuleTrait;

    public function __construct()
    {
        $this->setBase(fn(int|float $amount) => $amount * 11 / 12);
        $this->setRate(12);
    }
}