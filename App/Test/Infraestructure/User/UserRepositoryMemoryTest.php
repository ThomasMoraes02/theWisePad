<?php 
namespace App\Test\Infraestructure\User;

use App\Domain\User\Email;
use App\Domain\User\User;
use App\Infraestructure\UserPassowrdArgonII;
use App\Infraestructure\UserRepositoryMemory;
use PHPUnit\Framework\TestCase;

class UserRepositoryMemoryTest extends TestCase
{
    public function test_add_user()
    {
        $userPassword = new UserPassowrdArgonII();
        $passowrd = $userPassword->encrypt("123456");
        $user = User::withNameEmailPassword("Thomas", "thomas@gmail.com", $passowrd);

        $repository = new UserRepositoryMemory();
        $repository->addUser($user);

        $userFind = $repository->getUser(new Email($user->getEmail()));

        $this->assertEquals($user->getEmail(), $userFind->getEmail());
    }
}