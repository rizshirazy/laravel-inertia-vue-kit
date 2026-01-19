<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;

class LogoutUserAction
{
    public function execute(): void
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }
}
