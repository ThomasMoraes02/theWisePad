<?php 
namespace App\Domain\Auth;

interface Authentication
{
    public function auth(string $email, string $password): array;

    public function getInstances(): array;
}