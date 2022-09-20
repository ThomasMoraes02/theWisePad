<?php 
namespace App\Infraestructure;

use App\Domain\Auth\TokenManager;

class TokenUniq implements TokenManager
{
    public function sigIn(): string
    {
        return uniqid("auth-" . md5(rand()), true);
    }
}