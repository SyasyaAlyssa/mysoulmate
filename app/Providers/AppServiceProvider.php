<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\StudentNotification;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
   public function boot()
{
    View::composer('layouts.student', function ($view) {
        if (auth()->check() && auth()->user()->role === 'student') {
            $notificationCount = StudentNotification::where('user_id', auth()->id())
                ->where('is_read', false)
                ->count();

            $view->with('notificationCount', $notificationCount);
        }
    });
}
}