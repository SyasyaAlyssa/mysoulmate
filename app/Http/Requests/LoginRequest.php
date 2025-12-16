<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'matric_no' => ['required', 'string'], // <-- Use matric_no
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate()
    {
        $credentials = $this->only('matric_no', 'password');

        if (!Auth::attempt($credentials, $this->boolean('remember'))) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'matric_no' => __('These credentials do not match our records.'),
            ]);
        }
    }
}
