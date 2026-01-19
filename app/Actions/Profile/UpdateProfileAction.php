<?php

namespace App\Actions\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UpdateProfileAction
{
    public function execute(User $user, array $data): User
    {
        if (isset($data['profile_picture'])) {
            // Delete old profile picture if exists
            if ($user->profile_picture) {
                $oldPath = str_replace('/storage/', '', $user->profile_picture);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $data['profile_picture']->store('profile_pictures', 'public');
            $data['profile_picture'] = Storage::url($path);
        }

        $user->update([
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'profile_picture' => $data['profile_picture'] ?? $user->profile_picture,
        ]);

        return $user;
    }
}
