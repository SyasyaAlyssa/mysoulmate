<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Handle login redirect by role
        $this->app->singleton(LoginResponseContract::class, function () {
            return new class implements LoginResponseContract {
                public function toResponse($request)
                {
                    $user = Auth::user();

                    if ($user->role === 'admin') {
                        return redirect()->intended('/admin/dashboard');
                    }

                    if ($user->role === 'guardian') {
                        return redirect()->intended('/guardian/dashboard');
                    }

                    // Default student
                    return redirect()->intended('/student/dashboard');
                }
            };
        });

        // Handle register redirect by role
        $this->app->singleton(RegisterResponseContract::class, function () {
            return new class implements RegisterResponseContract {
                public function toResponse($request)
                {
                    $user = Auth::user();

                    if ($user->role === 'admin') {
                        return redirect('/admin/dashboard');
                    }

                    if ($user->role === 'guardian') {
                        return redirect('/guardian/dashboard');
                    }

                    // Default student
                    return redirect('/student/dashboard');
                }
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Load Fortify login/register views
        Fortify::loginView(fn () => view('auth.login'));
        Fortify::registerView(fn () => view('auth.register'));

        // Fortify actions
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        /**
         * CUSTOM AUTH LOGIC
         * Student: login via matric_no
         * Guardian/Admin: login via email
         */
Fortify::authenticateUsing(function (Request $request) {

    // If user selects student login
    if ($request->role === 'student') {
        $request->validate([
            'matric_no' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('matric_no', $request->matric_no)->first();
    }

    // If user selects guardian or admin
    else {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();
    }

    // Verify password
    if ($user && Hash::check($request->password, $user->password)) {
        return $user;
    }

    return null;
});


        // Rate limit login attempts
        RateLimiter::for('login', function (Request $request) {
            $identifier = $request->role === 'student'
                ? $request->matric_no
                : $request->email;

            return Limit::perMinute(5)->by(Str::lower($identifier) . '|' . $request->ip());
        });

        // 2FA rate limit
        RateLimiter::for('two-factor', fn (Request $request) =>
            Limit::perMinute(5)->by($request->session()->get('login.id'))
        );
    }
}
