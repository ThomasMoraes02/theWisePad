<?php 
namespace App\Test\Infraestructure;

use PHPUnit\Framework\TestCase;
use App\Infraestructure\UserPassowrdArgonII;

class UserPasswordTest extends TestCase
{
    public function test_verify_password()
    {
        $userPassword = new UserPassowrdArgonII();
        $passwordHash = $userPassword->encrypt("123456");
        
        $password = $userPassword->verifyPassword("123456", $passwordHash);

        $this->assertTrue($password);
    }
}