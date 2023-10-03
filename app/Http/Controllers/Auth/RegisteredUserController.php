<?php

namespace App\Http\Controllers\Auth;

use App\enums\TransactionTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CreateUserRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());

        if ($user->balance) {
            $user->transactions()->create([
               'transaction_type' => TransactionTypeEnum::DEPOSIT->value,
                'amount' => $user->balance,
                'fee' => 0,
                'date' => date('d-m-Y')
            ]);
        }

        return redirect(route('login'));
    }
}
