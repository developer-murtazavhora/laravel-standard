<?php

namespace App\Repositories;

use App\Interfaces\UsersInterface;
use App\User;

class UsersRepository implements UsersInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUsers()
    {
        return $this->user->get();
    }
}
