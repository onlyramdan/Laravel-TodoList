<?php

namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService
{
    
    private array $users = [
        
        "ramdan" => 'only',
    ];

    function login( string $user, string $password): bool
    {
        if(!isset($this->users[$user])){
            return false;
        }

        $correctpassword = $this->users[$user];
        return $password == $correctpassword; 
    }
}
