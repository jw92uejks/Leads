<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function storeOrUpdateAvatar(User $user, ?UploadedFile $file): string
    {
        $currentPath = $user->avatar ?? '';

        if ($file && $file->isValid()) {
            $normalizedCurrent = $this->normalizePath($currentPath);

            if ($normalizedCurrent !== '' && Storage::disk('public')->exists($normalizedCurrent)) {
                Storage::disk('public')->delete($normalizedCurrent);
            }

            $filename = now()->format('YmdHis') . '_' . $user->id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('avatars', $filename, 'public');

            return 'avatars/' . $filename;
        }

        return $this->normalizePath($currentPath);
    }

    private function normalizePath(?string $path): string
    {
        $value = $path ?? '';
        if ($value === '0') {
            return '';
        }
        if (str_starts_with($value, 'storage/')) {
            return substr($value, strlen('storage/'));
        }
        return $value;
    }

}


