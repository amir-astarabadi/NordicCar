<?php 

namespace App\Utilities\Authentication;

use Illuminate\Contracts\Auth\Authenticatable;

class AuthUtility
{
    public function login(Authenticatable $user, array|string $abilities = ['']):void
    {
        $abilities = is_string($abilities) ? [$abilities] : $abilities;

        $user->auth_token = $user->createToken('auth', $abilities)->plainTextToken;
    }
}