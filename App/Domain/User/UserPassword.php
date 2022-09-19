<?php 
namespace App\Domain\User;

interface UserPassword
{
    public function encrypt(string $password): string;

    public function verifyPassword(string $passwordText, string $passwordEncrypt): bool;
}