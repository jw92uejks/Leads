<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    public function creating(User $user): void
    {
        if (empty($user->ucode)) {
            $user->ucode = $this->generateUniqueUcode();
        }
    }

    private function generateUniqueUcode(): string
    {
        do {
            $ucode = Str::random(21);
        } while (User::where('ucode', $ucode)->exists());

        return $ucode;
    }
}
