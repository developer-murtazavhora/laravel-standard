<?php

namespace App\Http\Controllers;

use App\Repositories\UsersRepository;

class UsersController extends Controller
{
    protected $users_repository;

    public function __construct(UsersRepository $users_repository)
    {
        $this->users_repository = $users_repository;
    }

    public function index()
    {
        try {
            $users = $this->users_repository->getUsers();
            return view('users.index', compact('users'));
        } catch (\Exception $e) {
            return redirect()
                ->route('users.index')
                ->with('notification', [
                    'type'    => 'danger',
                    'message' => $e->getMessage()
                ]);
        }
    }
}
