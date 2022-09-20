<?php 
namespace App\Domain\Auth;

use App\Domain\User\User;

class TokenUniq implements TokenManager
{
    public function sigIn(): string
    {
        return md5(uniqid("auth-" . rand()), true);
    }
}