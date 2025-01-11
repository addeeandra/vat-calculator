# Vat Calculator ID

This library is a simple VAT calculator.

## What's in this library?

- VAT Rule 11%
- VAT Rule 12% with custom base (e.g. 11/12)
- VAT Calculator, when given VAT Rule, you can
    - Calculate VAT of an amount (e.g. AmountExclVat=100_000 => 11_000)
    - Extract VAT from an amount (e.g. AmountInclVat=111_000 => 11_000)
    - Get total amount include VAT (e.g. AmountExclVat=100_000 => 111_000)
    - Get amount exclude VAT from (e.g. AmountInclVat=111_000 => 100_000)

## Installation

You can install this package by simply running `composer require addeeandra/vat-calculator-id`

## Need Custom VAT Rule?

You can make custom VAT Rule using `VatRuleBuilder` considering how fluid is our country's regulation.

![image](https://i.imgflip.com/9gc1dd.jpg)

```php

// new VAT Rule 15% with base of 11 / 15 which equals to 11%
$newVatRule = \Addeeandra\VatCalculator\Builders\VatRuleBuilder::make()
    ->rate(15) // 15%
    ->base(fn (int|float $amount) => $amount * 11 / 15)
    ->build();

// new VAT Rule 15% with base of 11 / 15 which equals to 11%
$newVatRule = \Addeeandra\VatCalculator\Builders\VatRuleBuilder::make()
    ->rate(12) // 15%
    ->base(fn (int|float $amount) => $amount * 15 / 12)
    ->build();

```

## Roadmap

- [ ] Parse rule from a set of array

## License

MIT License