<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/

// Admin
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PreMarriageCourseController as AdminPreMarriageCourseController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

// Student
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\PreMarriageCourseController as StudentPreMarriageCourseController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Student\NotificationController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\MessageController;

// Guardian
use App\Http\Controllers\Guardian\DashboardController as GuardianDashboardController;
use App\Http\Controllers\Guardian\ProfileController as GuardianProfileController;


/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/
Route::view('/', 'welcome')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/testimony', 'testimony')->name('testimony');
Route::view('/premarriage', 'premarriage')->name('premarriage');


/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT (ROLE AWARE)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    return match (auth()->user()->role) {
        'admin'    => redirect()->route('admin.dashboard'),
        'student'  => redirect()->route('student.dashboard'),
        'guardian' => redirect()->route('guardian.dashboard'),
        default    => redirect()->route('home'),
    };
})->name('dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/upload-photo', [AdminController::class, 'showUploadForm'])
            ->name('upload-photo');

        Route::post('/upload-photo', [AdminController::class, 'uploadPhoto'])
            ->name('upload-photo.save');

        Route::resource('courses', AdminPreMarriageCourseController::class)
            ->except(['show']);

        Route::patch(
            '/courses/{course}/toggle-publish',
            [AdminPreMarriageCourseController::class, 'togglePublish']
        )->name('courses.toggle-publish');

        Route::resource('profiles', AdminProfileController::class)
            ->except(['show']);
    });


/*
|--------------------------------------------------------------------------
| STUDENT ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])
            ->name('dashboard');

        // Pre-marriage courses
        Route::get('/courses', [StudentPreMarriageCourseController::class, 'index'])
            ->name('courses.index');

        Route::get('/courses/{course}', [StudentPreMarriageCourseController::class, 'show'])
            ->name('courses.show');

        // Profile
        Route::get('/profile', [StudentProfileController::class, 'show'])
            ->name('profile.index');

        Route::get('/profile/edit', [StudentProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile', [StudentProfileController::class, 'update'])
            ->name('profile.update');

        Route::post('/profile/photo', [StudentProfileController::class, 'uploadPhoto'])
            ->name('profile.uploadPhoto');

        // Students list (for messaging / ta'aruf)
        Route::get('/students', [StudentController::class, 'index'])
            ->name('students.index');

        // Ta’aruf
        Route::post('/taaruf/{id}/send', [StudentController::class, 'sendRequest'])
            ->name('taaruf.send');

        // Notifications
        Route::get('/notifications', [NotificationController::class, 'index'])
            ->name('notifications.index');

        Route::post('/taaruf/{id}/accept', [NotificationController::class, 'accept'])
            ->name('taaruf.accept');

        Route::post('/taaruf/{id}/reject', [NotificationController::class, 'reject'])
            ->name('taaruf.reject');

        // 💬 MESSAGES (✅ FIXED – NOW INSIDE STUDENT GROUP)
        Route::get('/messages', [MessageController::class, 'users'])
            ->name('messages.users');

        Route::get('/messages/{user}', [MessageController::class, 'chat'])
            ->name('messages.chat');

        Route::post('/messages/{user}', [MessageController::class, 'send'])
            ->name('messages.send');
    });


/*
|--------------------------------------------------------------------------
| GUARDIAN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guardian'])
    ->prefix('guardian')
    ->name('guardian.')
    ->group(function () {

        Route::get('/dashboard', [GuardianDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/profile', [GuardianProfileController::class, 'index'])
            ->name('profile.index');
    });
