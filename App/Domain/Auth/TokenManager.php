<?php 
namespace App\Domain\Auth;

use App\Domain\User\User;

interface TokenManager
{
    public function sigIn(): string;
}