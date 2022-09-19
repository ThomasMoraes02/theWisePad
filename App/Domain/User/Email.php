<?php 
namespace App\Domain\User;

use App\Domain\Exceptions\EmailException;

class Email
{
    private $email;

    public function __construct(string $email)
    {
        $this->setEmail($email);
    }

    private function setEmail(string $email): void
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new EmailException();
        }

        $this->email = $email;
    }

    public function __toString()
    {
        return $this->email;
    }
}