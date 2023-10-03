<?php

namespace App\enums;

enum TransactionTypeEnum: string
{
    case DEPOSIT = "Deposit";
    case WITHDRAWAL = "Withdrawal";
}
