<?php 
namespace App\Domain\Exceptions;

use DomainException;

class EmailException extends DomainException
{
    public function __construct()
    {
        parent::__construct("E-mail invalid");
    }
}