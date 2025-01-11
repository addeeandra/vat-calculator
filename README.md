<p align="center">
    <h1 align="center">VAT Calculator</h1>
    <p align="center">Configurable VAT Rate &amp; Calculator</p>
    <p align="center">
        <a href="https://github.com/addeeandra/vat-calculator/actions">
            <img alt="GitHub Workflow Status (main)" src="https://github.com/addeeandra/vat-calculator/actions/workflows/tests.yml/badge.svg"/>
        </a>
        <a href="https://packagist.org/packages/addeeandra/paranoia">
            <img alt="Latest Stable Version" src="https://img.shields.io/packagist/v/addeeandra/vat-calculator"/>
        </a>
    </p>
</p>

------

# Vat Calculator ID

This library is a simple VAT calculator.

## What's in this library?

- VAT Rule 11%
- VAT Rule 12% with custom base (e.g. 11/12)
- VAT Calculator, when given VAT Rule, you can
    - Calculate VAT of an amount (e.g. `AmountExclVat=100_000` => `11_000`)
    - Extract VAT from an amount (e.g. `AmountInclVat=111_000` => `11_000`)
    - Get total amount include VAT (e.g. `AmountExclVat=100_000` => `111_000`)
    - Get amount exclude VAT from (e.g. `AmountInclVat=111_000` => `100_000`)

## Installation

You can install this package by simply running `composer require addeeandra/vat-calculator-id`

## How to use

To use this library is simple.

```php
use \Addeeandra\VatCalculator\Rules;
use \Addeeandra\VatCalculator\Builders;

# To use PPN 11% Rule
$rule = new Rules\Vat12Rule();
$rule->calculate(100_000); // 11_000 (float)
$rule->calculator()->vatInAmount(111_000); // 11_000 (float)

# To use PPN 12% Rule
$rule = new Rules\Vat12Rule();
$rule->calculate(100_000); // 11_000 (float)
$rule->calculator()->vatInAmount(111_000); // 11_000 (float)

```

See [VatRuleTest](tests/Unit/VatRuleTest.php) and [VatCalculatorTest](tests/Unit/VatCalculatorTest.php) for more
examples.

## Need Custom VAT Rule?

You can make custom VAT Rule using `VatRuleBuilder` considering how fluid is our country's regulation.

![image](https://i.imgflip.com/9gc1dd.jpg)

```php

// new VAT Rate 12% without base 11/12
$newVatRule = \Addeeandra\VatCalculator\Builders\VatRuleBuilder::make()
    ->rate(12) // 12%
    ->build();

// new VAT Rate 12% with base 15/12 which equals to 15%
$newVatRule = \Addeeandra\VatCalculator\Builders\VatRuleBuilder::make()
    ->rate(12) // 12%
    ->base(fn (int|float $amount) => $amount * 15 / 12) // whoops, it's actually 15% :)
    ->build();

```

## License

MIT License
