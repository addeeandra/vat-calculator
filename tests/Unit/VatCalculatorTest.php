<?php

describe('VAT Calculator', function () {

    test('VAT 11% calculator', function () {
        $vat = new \Addeeandra\VatCalculator\Rules\Vat11Rule();
        $calculator = $vat->calculator();

        expect($calculator->rule())->toBe($vat)
            ->and($calculator->vatOfAmount(100_000))->toBe(11_000.0)
            ->and($calculator->vatInAmount(111_000))->toBe(11_000.0)
            ->and($calculator->amountWithVat(100_000))->toBe(111_000.0)
            ->and($calculator->amountWithoutVat(111_000))->toBe(100_000.0);
    });

    test('VAT 12% => 11% calculator', function () {
        $vat = new \Addeeandra\VatCalculator\Rules\Vat12Rule();
        $calculator = $vat->calculator();

        expect($calculator->rule())->toBe($vat)
            ->and($calculator->vatOfAmount(100_000))->toBe(11_000.0)
            ->and($calculator->vatInAmount(111_000))->toBe(11_000.0)
            ->and($calculator->amountWithVat(100_000))->toBe(111_000.0)
            ->and($calculator->amountWithoutVat(111_000))->toBe(100_000.0);
    });

});