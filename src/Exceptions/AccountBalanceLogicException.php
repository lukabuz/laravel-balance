<?php

namespace Lukabuz\LaravelBalance\Exceptions;

use Money\Currency;
use Lukabuz\LaravelBalance\Models\Interfaces\AccountBalanceHolderInterface;

class AccountBalanceLogicException extends \LogicException
{
    public static function accountAlreadyExists(AccountBalanceHolderInterface $accountBalanceHolder, Currency $currency)
    {
        return new self(
            sprintf('The %s account for %s already exists', get_class($accountBalanceHolder), $currency->getCode())
        );
    }
}