<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    /**
     * Validate and create a newly registered user.
     */
    public function create(array $input)
    {
        // Validate fields
        Validator::make($input, [
            'role' => ['required', 'string', 'in:student,guardian,admin'],

            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            // Matric number required only for student
            'matric_no' => [
                'required_if:role,student',
                'nullable',
                'string',
                'max:50',
            ],

            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ])->validate();

        // Create user
        return User::create([
            'role'       => $input['role'],
            'name'       => $input['name'],
            'email'      => $input['email'],
            'matric_no'  => $input['matric_no'] ?? null,
            'password'   => Hash::make($input['password']),
        ]);
    }
}
