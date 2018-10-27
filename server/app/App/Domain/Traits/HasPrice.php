<?php

namespace App\App\Domain\Traits;
use App\App\Domain\Cart\Money;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use NumberFormatter;

/**
 * Money Trait
 */
trait HasPrice
{
    public function getPriceAttribute($value)
    {
        return new Money($value);
    }
    public function getFormattedPriceAttribute()
    {
       return $this->price->formatted();
    }

}