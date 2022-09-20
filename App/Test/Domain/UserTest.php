<?php 
namespace App\Test\Domain;

use App\Domain\User\Email;
use App\Domain\User\User;
use App\Infraestructure\UserPasswordArgonII;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $passwordHash;

    public function setUp()
    {
        $passwordHash = new UserPasswordArgonII();
        $this->passwordHash = $passwordHash->encrypt("123456");
    }

    public function test_create_user()
    {
        $user = new User("Thomas", new Email("thomas@gmail.com"), $this->passwordHash);
        $this->assertEquals("Thomas", $user->getName());
    }

    public function test_create_user_refactor()
    {
        $user = User::withNameEmailPassword("Thomas", "thomas@gmail.com", $this->passwordHash);
        $this->assertEquals("thomas@gmail.com", $user->getEmail());
    }
}