<?php

namespace Lukabuz\LaravelBalance\Assemblers;

use Lukabuz\LaravelBalance\Models\Transaction;
use Lukabuz\LaravelBalance\Dto\TransactionDto;

class TransactionDtoAssembler
{
    public function dtoToModel(TransactionDto $transactionDto): Transaction
    {
        $transactionModel = new Transaction();
        $transactionModel->amount = $transactionDto->getAmount();
        $transactionModel->type = $transactionDto->getType();

        return $transactionModel;
    }
}