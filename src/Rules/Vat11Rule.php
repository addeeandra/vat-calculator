<?php

namespace Addeeandra\VatCalculator\Rules;

use Addeeandra\VatCalculator\Contracts\AsVatRule;
use Addeeandra\VatCalculator\Traits\VatRuleTrait;

class Vat11Rule implements AsVatRule
{
    use VatRuleTrait;

    public function __construct()
    {
        $this->setBase(1);
        $this->setRate(11);
    }
}