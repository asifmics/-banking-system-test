<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {

        return Inertia::render(
            component: 'Dashboard',
            props: [
                'transactions' => Transaction::where('user_id',auth()->id())->get(),
                'currentBalance' => auth()->user()->currentBalance(),
            ]
        );
    }
}
