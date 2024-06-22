<?php

namespace App\Services;

use App\Exceptions\InvalidPasswordException;
use App\Exceptions\UserNotFoundExeception;
use App\Http\Resources\UserResource;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Array_;

class AuthService
{
    public function register(array $data) : UserResource
    {
        return DB::transaction(function () use ($data) {
            return UserResource::make(User::create(
                [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]
            ));
        });
    }

    public function login(string $email, string $password) : UserResource
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new UserNotFoundExeception();
        }
        if (!Hash::check($password, $user->password)) {
            throw new InvalidPasswordException();
        }

        return $user->createToken('auth_token')->plainTextToken;
    }

}