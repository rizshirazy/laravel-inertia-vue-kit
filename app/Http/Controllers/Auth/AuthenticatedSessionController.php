<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\LoginUserAction;
use App\Actions\Auth\LogoutUserAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Auth/Login');
    }

    public function store(Request $request, LoginUserAction $loginUserAction): RedirectResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $loginUserAction->execute(
            $request->only('email', 'password'),
            $request->boolean('remember')
        );

        return redirect()->intended(route('dashboard'));
    }

    public function destroy(LogoutUserAction $logoutUserAction): RedirectResponse
    {
        $logoutUserAction->execute();

        return redirect()->to('/');
    }
}
