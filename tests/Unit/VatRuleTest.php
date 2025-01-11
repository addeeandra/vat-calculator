<?php

// based on BPS, Indonesia GDP in Q1 2024 is around IDR 5.4 quadrillion (or IDR 5_4xx trillion)
// in here, we test it out with 1 quadrillion (1_000 trillion)
//
// note: after 1_000 kuadriliun or more the number will be converted to scientific notation
describe('Predefined VatRule Tests', function () {

    test('VAT 11% should returns correct VAT 11%', function () {
        $vatRule = new \Addeeandra\VatCalculator\Rules\Vat11Rule();
        expect($vatRule->calculate(1_000))->toBe(110.0)
            ->and($vatRule->calculate(2_000))->toBe(220.0)
            ->and($vatRule->calculate(3_000))->toBe(330.0)
            ->and($vatRule->calculate(5_000))->toBe(550.0)
            ->and($vatRule->calculate(8_000))->toBe(880.0)
            ->and($vatRule->calculate(13_000))->toBe(1_430.0)
            ->and($vatRule->calculate(15_000))->toBe(1_650.0)
            ->and($vatRule->calculate(28_000))->toBe(3_080.0)
            ->and($vatRule->calculate(1))->toBe(0.11)
            ->and($vatRule->calculate(1_000_000_000))->toBe(110_000_000.0) // 1 miliar
            ->and($vatRule->calculate(1_000_000_000_000))->toBe(110_000_000_000.0) // 1 triliun
            ->and($vatRule->calculate(1_000_000_000_000_000))->toBe(110_000_000_000_000.0) // 1_000 triliun / 1 kuadriliun
            ->and($vatRule->calculate(5_000_000_000_000_000))->toBe(550_000_000_000_000.0) // 5_000 triliun / 5 kuadriliun
            ->and($vatRule->calculate(1_000_000_000_000_000_000))->toBe(1.1E+17)
            ->and($vatRule->calculate(1_555_000_250_000_000_000))->toBe(1.710500275E+17);
    });

    test('VAT 12% should returns correct VAT 12% with custom base 11/12', function () {
        $vatRule = new \Addeeandra\VatCalculator\Rules\Vat12Rule();

        expect($vatRule->calculate(1_000))->toBe(110.0)
            ->and($vatRule->calculate(2_000))->toBe(220.0)
            ->and($vatRule->calculate(3_000))->toBe(330.0)
            ->and($vatRule->calculate(5_000))->toBe(550.0)
            ->and($vatRule->calculate(8_000))->toBe(880.0)
            ->and($vatRule->calculate(13_000))->toBe(1_430.0)
            ->and($vatRule->calculate(15_000))->toBe(1_650.0)
            ->and($vatRule->calculate(28_000))->toBe(3_080.0)
            ->and($vatRule->calculate(1))->toBe(0.11)
            ->and($vatRule->calculate(1_000_000_000))->toBe(110_000_000.0) // 1 miliar
            ->and($vatRule->calculate(1_000_000_000_000))->toBe(110_000_000_000.0) // 1 triliun
            ->and($vatRule->calculate(1_000_000_000_000_000))->toBe(110_000_000_000_000.0) // 1_000 triliun / 1 kuadriliun
            ->and($vatRule->calculate(5_000_000_000_000_000))->toBe(550_000_000_000_000.0) // 5_000 triliun / 5 kuadriliun
            ->and($vatRule->calculate(1_000_000_000_000_000_000))->toBe(1.1E+17)
            ->and($vatRule->calculate(1_555_000_250_000_000_000))->toBe(1.710500275E+17);
    });

});

describe('Customized VAT Rule Test', function () {
    test('VAT 12% should returns correct VAT 12% without custom base', function () {
        $vatRule = \Addeeandra\VatCalculator\Builders\VatRuleBuilder::make()
            ->rate(12)
            ->build();

        expect($vatRule->calculate(1_000))->toBe(120.0)
            ->and($vatRule->calculate(2_000))->toBe(240.0)
            ->and($vatRule->calculate(3_000))->toBe(360.0)
            ->and($vatRule->calculate(5_000))->toBe(600.0)
            ->and($vatRule->calculate(8_000))->toBe(960.0)
            ->and($vatRule->calculate(13_000))->toBe(1_560.0)
            ->and($vatRule->calculate(15_000))->toBe(1_800.0)
            ->and($vatRule->calculate(28_000))->toBe(3360.0)
            ->and($vatRule->calculate(1))->toBe(0.12)
            ->and($vatRule->calculate(1_000_000_000))->toBe(120_000_000.0) // 1 miliar
            ->and($vatRule->calculate(1_000_000_000_000))->toBe(120_000_000_000.0) // 1 triliun
            ->and($vatRule->calculate(1_000_000_000_000_000))->toBe(120_000_000_000_000.0) // 1_000 triliun / 1 kuadriliun
            ->and($vatRule->calculate(5_000_000_000_000_000))->toBe(600_000_000_000_000.0) // 5_000 triliun / 5 kuadriliun
            ->and($vatRule->calculate(1_000_000_000_000_000_000))->toBe(1.2E+17)
            ->and($vatRule->calculate(1_555_000_250_000_000_000))->toBe(1.8660003E+17);
    });
    test('VAT 15% should returns correct VAT 15% with base of 12/15', function () {
        $vatRule = \Addeeandra\VatCalculator\Builders\VatRuleBuilder::make()
            ->base(fn(int|float $amount) => $amount * 12.0 / 15)
            ->rate(15)
            ->build();

        expect($vatRule->calculate(1_000))->toBe(120.0)
            ->and($vatRule->calculate(2_000))->toBe(240.0)
            ->and($vatRule->calculate(3_000))->toBe(360.0)
            ->and($vatRule->calculate(5_000))->toBe(600.0)
            ->and($vatRule->calculate(8_000))->toBe(960.0)
            ->and($vatRule->calculate(13_000))->toBe(1_560.0)
            ->and($vatRule->calculate(15_000))->toBe(1_800.0)
            ->and($vatRule->calculate(28_000))->toBe(3360.0)
            ->and($vatRule->calculate(1))->toBe(0.12)
            ->and($vatRule->calculate(1_000_000_000))->toBe(120_000_000.0) // 1 miliar
            ->and($vatRule->calculate(1_000_000_000_000))->toBe(120_000_000_000.0) // 1 triliun
            ->and($vatRule->calculate(1_000_000_000_000_000))->toBe(120_000_000_000_000.0) // 1_000 triliun / 1 kuadriliun
            ->and($vatRule->calculate(5_000_000_000_000_000))->toBe(600_000_000_000_000.0) // 5_000 triliun / 5 kuadriliun
            ->and($vatRule->calculate(1_000_000_000_000_000_000))->toBe(1.2E+17)
            ->and($vatRule->calculate(1_555_000_250_000_000_000))->toBe(1.8660003E+17);
    });
});
