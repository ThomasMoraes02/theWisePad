<?php 
namespace App\Infraestructure;

use App\Domain\Exceptions\UserException;
use App\Domain\User\Email;
use App\Domain\User\User;
use App\Domain\User\UserPassword;
use App\Domain\User\UserRepository;

class UserRepositoryMemory implements UserRepository
{
    private $users = [];

    public function addUser(User $user): void
    {
        $this->users[] = $user;
    }

    public function getUser(Email $email): User
    {
        $user = array_filter($this->users, function(User $user) use ($email) {
            if($user->getEmail() == $email) {
                return $user;
            }
        });

        if(empty($user)) {
            throw new UserException($email);
        }

        return $user[0];
    }
}