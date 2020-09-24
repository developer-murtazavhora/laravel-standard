<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\API\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    protected $users_repository;

    public function __construct(UsersRepository $users_repository)
    {
        $this->users_repository = $users_repository;
    }

    public function login(Request $request)
    {
        try {
            $data      = $request->all();
            $validator = Validator::make($data, array(
                'email'    => 'required|email',
                'password' => 'required'
            ));
            if ($validator->fails()) {
                throw new \Exception(implode('<br>', $validator->getMessageBag()->all()), 201);
            }

            $response = $this->users_repository->login($data);

            if ($response) {
                return response()
                    ->json([
                        'success' => true,
                        'code'    => 200,
                        'message' => 'Login.'
                    ]);
            }

            return response()
                ->json([
                    'success' => false,
                    'code'    => 201,
                    'message' => 'Invalid credentials.'
                ]);
        } catch (\Exception $e) {
            return response()
                ->json([
                    'success' => false,
                    'code'    => $e->getCode(),
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function register(Request $request)
    {
        try {
            $data      = $request->all();
            $validator = Validator::make($data, array(
                'name'     => 'required',
                'email'    => 'required|email|unique:users',
                'password' => 'required'
            ));
            if ($validator->fails()) {
                throw new \Exception(implode('<br>', $validator->getMessageBag()->all()), 201);
            }

            $data['password'] = bcrypt($data['password']);
            $this->users_repository->register($data);
            return response()
                ->json([
                    'success' => true,
                    'code'    => 200,
                    'message' => 'Register.'
                ]);
        } catch (\Exception $e) {
            return response()
                ->json([
                    'success' => false,
                    'code'    => $e->getCode(),
                    'message' => $e->getMessage()
                ]);
        }
    }
}
