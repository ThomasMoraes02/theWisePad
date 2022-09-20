<?php 
namespace App\Domain\UseCases;

use App\Domain\Auth\Authentication;
use App\Domain\Exceptions\AuthException;
use App\Domain\Exceptions\UserException;
use App\Domain\User\Email;
use App\Domain\User\User;

class SignUp implements UseCase
{
    private $userRepository;

    private $userPassword;

    private $authentication;

    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;

        $instances = $this->authentication->getInstances();
        $this->userRepository = $instances['user_repository'];
        $this->userPassword = $instances['user_password'];
    }

    public function perform($userData)
    {   
        try {
            $user = $this->userRepository->getUser(new Email($userData['email']));
            $userPasswordHash = $this->userPassword->verifyPassword($userData['password'], $user->getPassword());

            if($userPasswordHash === false) {
                throw new AuthException();
            }

        } catch(UserException $e) {
            $userDataPassword = $this->userPassword->encrypt($userData['password']);
            $user = User::withNameEmailPassword($userData['name'], $userData['email'], $userDataPassword);
            $this->userRepository->addUser($user);
        }

        $auth = $this->authentication->auth($user->getEmail(), $userData['password']);

        return $auth;
    }
}