<?php

namespace App\App\Domain\Cart;
use NumberFormatter;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money as BaseMoney;

/**
 * Money Transformer
 */
class Money
{
    private $money;

    public function __construct($value)
    {
        $this->money = new BaseMoney($value , new Currency('GBP'));
    }
    public function amount()
    {
        return $this->money->getAmount();
    }
    public function formatted()
    {
        $formatter = new IntlMoneyFormatter(
            new NumberFormatter('en_GB',NumberFormatter::CURRENCY),
            new ISOCurrencies
        );
        return $formatter->format($this->money);
    }
    public function add(Money $money)
    {
        $this->money = $this->money->add($money->instance());
        return $this;
    }
    public function instance()
    {
        return $this->money;
    }
}
