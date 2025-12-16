<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Providers\RouteServiceProvider;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
          $role = auth()->user()->role;

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'guardian':
                return redirect()->route('guardian.dashboard');
            case 'student':
            default:
                return redirect()->route('student.dashboard');

        return redirect()->intended(RouteServiceProvider::redirectTo());
    }
    
}
}