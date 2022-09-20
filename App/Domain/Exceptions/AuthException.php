<?php 
namespace App\Domain\Exceptions;

use DomainException;

class AuthException extends DomainException
{
    public function __construct()
    {
        parent::__construct("Invalid e-mail or password");
    }
}