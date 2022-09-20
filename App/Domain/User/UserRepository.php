<?php 
namespace App\Domain\User;

interface UserRepository
{
    public function addUser(User $user): void;

    public function getUser(Email $email): User;
}