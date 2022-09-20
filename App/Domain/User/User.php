<?php 
namespace App\Domain\User;

use App\Domain\User\Email;
use App\Domain\User\UserPassword;
use App\Infraestructure\UserPassowrdArgonII;

class User
{
    private $name;

    private $email;

    private $password;

    public function __construct(string $name, Email $email, string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public static function withNameEmailPassword(string $name, string $email, string $password)
    {
        return new User($name, new Email($email), $password);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
}