<?php

namespace Addeeandra\VatCalculator\Contracts;

interface AsVatCalculator
{
    public function rule(): AsVatRule;

    /**
     * Get the vat based on given amount.
     *
     * @param float|int $amountExcludedVat
     * @return float|int
     */
    public function vatOfAmount(float|int $amountExcludedVat): float|int;

    /**
     * Get the vat included amount based on given amount.
     *
     * @param float|int $amountIncludedVat
     * @return float|int
     */
    public function vatInAmount(float|int $amountIncludedVat): float|int;

    /**
     * Get the vat included amount based on given amount.
     *
     * @param float|int $amountExcludedVat
     * @return float|int
     */
    public function amountWithVat(float|int $amountExcludedVat): float|int;

    /**
     * Get the vat excluded amount based on given amount.
     *
     * @param float|int $amountIncludedVat
     * @return float|int
     */
    public function amountWithoutVat(float|int $amountIncludedVat): float|int;
}