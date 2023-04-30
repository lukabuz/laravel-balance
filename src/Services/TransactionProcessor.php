<?php

namespace Lukabuz\LaravelBalance\Services;

use Lukabuz\LaravelBalance\Assemblers\TransactionDtoAssembler;
use Lukabuz\LaravelBalance\Dto\TransactionDto;
use Lukabuz\LaravelBalance\Models\AccountBalance;
use Lukabuz\LaravelBalance\Models\Transaction;

class TransactionProcessor
{
    /**
     * @var TransactionDtoAssembler
     */
    private $transactionDtoAssembler;

    /**
     * @param TransactionDtoAssembler $transactionDtoAssembler
     */
    public function __construct(TransactionDtoAssembler $transactionDtoAssembler)
    {
        $this->transactionDtoAssembler = $transactionDtoAssembler;
    }

    /**
     * @param AccountBalance $accountBalance
     * @param TransactionDto $transactionDto
     * @return Transaction
     */
    public function create(AccountBalance $accountBalance, TransactionDto $transactionDto): Transaction
    {
        $transaction = $this->transactionDtoAssembler->dtoToModel($transactionDto);

        // Associate transaction with account balance.
        $accountBalance->addTransaction($transaction);

        // Change account balance value.
        $balance = $accountBalance->getBalance();
        $balance = $balance->add($transaction->getAmount());
        $accountBalance->updateBalance($balance);

        // Save models.
        $transaction->save();
        $accountBalance->save();

        return $transaction;
    }
}