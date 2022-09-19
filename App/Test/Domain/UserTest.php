<?php 
namespace App\Test\Domain;

use App\Domain\User\Email;
use App\Domain\User\User;
use App\Infraestructure\UserPassowrdArgonII;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_create_user()
    {
        $user = new User("Thomas", new Email("thomas@gmail.com"), new UserPassowrdArgonII("123456"));
        $this->assertEquals("Thomas", $user->getName());
    }

    public function test_create_user_refactor()
    {
        $user = User::withNameEmailPassword("Thomas", "thomas@gmail.com", new UserPassowrdArgonII("123456"));
        $this->assertEquals("thomas@gmail.com", $user->getEmail());
    }
}