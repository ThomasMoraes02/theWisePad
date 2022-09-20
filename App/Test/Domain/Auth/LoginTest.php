<?php 
namespace App\Test\Domain\Auth;

use App\Domain\User\User;
use PHPUnit\Framework\TestCase;
use App\Infraestructure\TokenUniq;
use App\Domain\Exceptions\UserException;
use App\Infraestructure\CustomAuthenticate;
use App\Infraestructure\UserPasswordArgonII;
use App\Infraestructure\UserRepositoryMemory;

class LoginTest extends TestCase
{
    private $repository;
    private $passwordHash;
    private $tokenManager;
    private $authenticateUser;

    public function setUp()
    {
        $this->repository = new UserRepositoryMemory();
        $this->passwordHash = new UserPasswordArgonII();
        $this->tokenManager = new TokenUniq();

        $passwordUser = $this->passwordHash->encrypt("123456");
        $user = User::withNameEmailPassword("Thomas", "thomas@gmail.com", $passwordUser);

        $this->repository->addUser($user);

        $this->authenticateUser = new CustomAuthenticate($this->repository, $this->passwordHash, $this->tokenManager);

        parent::setUp();
    }

    public function test_user_login()
    {
        $auth = $this->authenticateUser->auth("thomas@gmail.com", "123456");
        $this->assertEquals("thomas@gmail.com", $auth['email']);
    }

    public function test_user_not_found()
    {
        $this->expectException(UserException::class);
        $this->authenticateUser->auth("caique@gmail.com", "11111");
    }
}