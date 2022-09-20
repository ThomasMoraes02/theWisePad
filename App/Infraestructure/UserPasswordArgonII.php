<?php 
namespace App\Infraestructure;

use App\Domain\User\UserPassword;

class UserPasswordArgonII implements UserPassword
{
    public function encrypt(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2I);
    }

    public function verifyPassword(string $passwordText, string $passwordEncrypt): bool
    {
        return password_verify($passwordText, $passwordEncrypt);
    }
}