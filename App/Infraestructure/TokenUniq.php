<?php 
namespace App\Infraestructure;

use App\Domain\Auth\TokenManager;

class TokenUniq implements TokenManager
{
    public function sigIn(): string
    {
        return md5(uniqid("auth-" . rand()), true);
    }
}