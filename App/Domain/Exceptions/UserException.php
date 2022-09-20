<?php 
namespace App\Domain\Exceptions;

use App\Domain\User\Email;
use DomainException;

class UserException extends DomainException
{
    public function __construct(string $email = '')
    {
        parent::__construct("User with e-mail: $email not found");
    }
}