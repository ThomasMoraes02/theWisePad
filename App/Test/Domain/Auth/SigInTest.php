<?php 
namespace App\Test\Domain\Auth;

use App\Domain\Exceptions\AuthException;
use App\Domain\User\User;
use App\Domain\UseCases\SignUp;
use PHPUnit\Framework\TestCase;
use App\Infraestructure\TokenUniq;
use App\Domain\Exceptions\UserException;
use App\Infraestructure\CustomAuthenticate;
use App\Infraestructure\UserPasswordArgonII;
use App\Infraestructure\UserRepositoryMemory;

class SiginTest extends TestCase
{
    private $repository;
    private $passwordHash;
    private $tokenManager;
    private $siginUp;

    public function setUp()
    {
        $this->repository = new UserRepositoryMemory();
        $this->passwordHash = new UserPasswordArgonII();
        $this->tokenManager = new TokenUniq();

        $authenticateService = new CustomAuthenticate($this->repository, $this->passwordHash, $this->tokenManager);

        $this->siginUp = new SignUp($this->repository, $this->passwordHash, $authenticateService);

        $userThomas = User::withNameEmailPassword("Thomas", "thomas@gmail.com", "987654");
        $this->repository->addUser($userThomas);

        parent::setUp();
    }

    public function test_user_signUp()
    {
        $userData = ['name' => 'Igor', 'email' => 'igor@gmail.com', 'password' => '123456'];

        $auth = $this->siginUp->perform($userData);

        $this->assertEquals("igor@gmail.com", $auth['email']);
        $this->assertEquals(2, count($this->repository->getAll()));
    }

    public function test_user_invalid()
    {
        $userData = ['name' => 'Thomas', 'email' => 'thomas@gmail.com', 'password' => '123456'];
        $this->expectException(AuthException::class);
        $this->siginUp->perform($userData);
    }
}