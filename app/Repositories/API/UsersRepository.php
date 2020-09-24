<?php

namespace App\Repositories\API;

use App\User;
use Illuminate\Support\Facades\Hash;

class UsersRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login($data)
    {
        $user = $this->user->where('email', $data['email'])->first();

        if (!isset($user)) {
            return false;
        }

        if (!Hash::check($data['password'], $user->password)) {
            return false;
        }

        return true;
    }

    public function register($data)
    {
        return $this->user->create($data);
    }
}
