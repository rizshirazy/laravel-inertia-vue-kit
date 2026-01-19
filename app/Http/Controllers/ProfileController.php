<?php

namespace App\Http\Controllers;

use App\Actions\Profile\UpdatePasswordAction;
use App\Actions\Profile\UpdateProfileAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'user' => $request->user()->only('name', 'email', 'profile_picture'),
        ]);
    }

    public function update(Request $request, UpdateProfileAction $updateProfileAction): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email,' . $request->user()->id,
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        $updateProfileAction->execute($request->user(), $request->only('name', 'email') + [
            'profile_picture' => $request->file('profile_picture')
        ]);

        return redirect()->route('profile.edit')->with('success', 'Profile information updated.');
    }

    public function updatePassword(Request $request, UpdatePasswordAction $updatePasswordAction): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $updatePasswordAction->execute($request->user(), $request->only('current_password', 'new_password'));

        return redirect()->route('profile.edit')->with('success', 'Password updated successfully.');
    }
}
