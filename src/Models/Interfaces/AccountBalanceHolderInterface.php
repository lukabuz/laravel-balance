<?php

namespace Lukabuz\LaravelBalance\Models\Interfaces;

use Lukabuz\LaravelBalance\Models\AccountBalance;

interface AccountBalanceHolderInterface
{
    public function getAccount(string $currency): ?AccountBalance;

    public function addAccountBalance(AccountBalance $accountBalance);
}