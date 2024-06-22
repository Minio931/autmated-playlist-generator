<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    const REGISTER_ROUTE = 'auth.register';
    const LOGIN_ROUTE = 'auth.login';
    const NAME_KEY = 'name';
    const EMAIL_KEY = 'email';
    const PASSWORD_KEY = 'password';

    private static $rules = [
        self::REGISTER_ROUTE => [
            self::NAME_KEY => 'required|string',
            self::EMAIL_KEY => 'required|email',
            self::PASSWORD_KEY => 'required|string',
        ],
        self::LOGIN_ROUTE => [
            self::EMAIL_KEY => 'required|email',
            self::PASSWORD_KEY => 'required|string',
        ],
    ];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return self::$rules[$this->route()->getName()];
    }

}