<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        $request->authenticate(); // validates login
        $request->session()->regenerate();

        $user = $request->user();

        // Redirect to named route based on role
        if ($user->role == 'guardian') {
            return redirect()->route('guardian.dashboard');
        } elseif ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == 'student') {
            return redirect()->route('student.dashboard');
        }

        // fallback
        return redirect()->route('dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
