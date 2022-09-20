<?php

use App\Domain\User\User;
use App\Infraestructure\CustomAuthenticate;
use App\Infraestructure\TokenUniq;
use App\Infraestructure\UserPasswordArgonII;
use App\Infraestructure\UserRepositoryMemory;

require_once("vendor/autoload.php");



try {
    $repository = new UserRepositoryMemory();
    $passwordHash = new UserPasswordArgonII();

    $userPasswordHash1 = $passwordHash->encrypt("123456");
    $userPasswordHash2 = $passwordHash->encrypt("654321");
    
    $user1 = User::withNameEmailPassword("Thomas", "thomas@gmail.com", $userPasswordHash1);
    $user2 = User::withNameEmailPassword("Caique", "caique@gmail.com", $userPasswordHash2);
    $repository->addUser($user1);
    $repository->addUser($user2);
    
    $customAuthenticate = new CustomAuthenticate($repository, $passwordHash, new TokenUniq());
    
    $auth = $customAuthenticate->auth("thomas@gmail.com", "123456");

    // print_r($repository);
    print_r($auth);

} catch(Throwable $e) {
    $errors = [
        'Message' => $e->getMessage(),
        'File' => $e->getFile(),
        'Line' => $e->getLine()
    ];
    
    print_r($errors);
}