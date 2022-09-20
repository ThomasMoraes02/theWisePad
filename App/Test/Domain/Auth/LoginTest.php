<?php 
namespace App\Test\Domain\Auth;

use App\Domain\Auth\CustomAuthenticate;
use App\Domain\Auth\TokenUniq;
use App\Domain\Exceptions\UserException;
use App\Domain\User\User;
use App\Infraestructure\UserPassowrdArgonII;
use App\Infraestructure\UserRepositoryMemory;
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    private $repository;
    private $passwordHash;
    private $tokenManager;
    private $authenticateUser;

    public function setUp()
    {
        $this->repository = new UserRepositoryMemory();
        $this->passwordHash = new UserPassowrdArgonII();
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
        $auth = $this->authenticateUser->auth("caique@gmail.com", "11111");
    }
}