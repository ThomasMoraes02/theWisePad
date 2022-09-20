<?php 
namespace App\Domain\Exceptions;

use App\Domain\User\Email;
use DomainException;

class UserException extends DomainException
{
    public function __construct(string $text)
    {
        if($text instanceof Email) {
            parent::__construct("User with e-mail: $text not found");
        }       
    }
} 