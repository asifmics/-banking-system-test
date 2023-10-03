<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{
    public function deposit(): Response
    {
        return Inertia::render(
            component: 'Transaction/Deposit',
            props: [
                'deposit' => Transaction::deposits()->get(),
            ]
        );
    }
}
