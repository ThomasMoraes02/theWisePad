<?php 
namespace App\Domain\UseCases;

use App\Domain\User\User;

interface UseCase
{
    public function perform($userData);
}