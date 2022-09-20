<?php
namespace App\Infraestructure;

use App\Domain\User\Email;
use App\Domain\Auth\TokenManager;
use App\Domain\User\UserPassword;
use App\Domain\Auth\Authentication;
use App\Domain\User\UserRepository;
use App\Domain\Exceptions\AuthException;
use App\Domain\Exceptions\UserException;

class CustomAuthenticate implements Authentication
{
    private $userRepository;

    private $userPassword;

    private $tokenManager;

    public function __construct(UserRepository $userRepository, UserPassword $userPassword, TokenManager $tokenManager)
    {
        $this->userRepository = $userRepository;
        $this->userPassword = $userPassword;
        $this->tokenManager = $tokenManager;
    }

    public function auth(string $email, string $password): array
    {
        $userAuth = $this->userRepository->getUser(new Email($email));

        if(!$userAuth) {
            throw new UserException($email);
        }

        $authPassword = $this->userPassword->verifyPassword($password, $userAuth->getPassword());

        if(!$authPassword) {
            throw new AuthException();
        }

        $accessToken = $this->tokenManager->sigIn();

        return [
            "accessToken" => $accessToken,
            "email" => $userAuth->getEmail()
        ];
    }
}   