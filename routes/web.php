<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\Admin\UserController;


Route::get('/', [FrontController::class, 'index'])->name('home');

Route::get('/course/{course:slug}', [FrontController::class, 'details'])->name('front.details');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {


    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');


    Route::resource('courses', \App\Http\Controllers\Admin\CourseController::class)
        ->names('admin.courses');

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)
        ->only(['index', 'destroy'])
        ->names('admin.users');
});


Route::middleware(['auth', 'role:instructor'])->prefix('instructor')->group(function () {

    Route::get('/dashboard', function () {
        return "<h1>Ini Halaman Dashboard INSTRUCTOR</h1>";
    })->name('instructor.dashboard');
});


Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('/my-courses', function () {
        return "<h1>Ini Halaman Kursus Saya (Student)</h1>";
    })->name('student.dashboard');
});


Route::middleware(['auth', 'role:student|admin|instructor'])->group(function () {


    Route::post('/course/{course:slug}/join', [\App\Http\Controllers\Front\CheckoutController::class, 'store'])->name('front.checkout.store');


    Route::post('/learning/{course:slug}/{lesson}/complete', [\App\Http\Controllers\Front\CourseProgressController::class, 'markAsComplete'])
        ->name('learning.complete');

    Route::get('/learning/{course:slug}/certificate', [\App\Http\Controllers\Front\CourseProgressController::class, 'downloadCertificate'])
        ->name('learning.certificate');


    Route::get('/learning/{course:slug}', [\App\Http\Controllers\Front\LearningController::class, 'index'])->name('learning.index');
    Route::get('/learning/{course:slug}/{lesson}', [\App\Http\Controllers\Front\LearningController::class, 'index'])->name('learning.show');


    Route::get('/profile', [\App\Http\Controllers\Front\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Front\ProfileController::class, 'update'])->name('profile.update');


    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)
        ->names('admin.categories');
});


    Route::get('/courses/{course}/lessons', [\App\Http\Controllers\Admin\LessonController::class, 'index'])->name('admin.courses.lessons.index');
    Route::get('/courses/{course}/lessons/create', [\App\Http\Controllers\Admin\LessonController::class, 'create'])->name('admin.courses.lessons.create');
    Route::post('/courses/{course}/lessons', [\App\Http\Controllers\Admin\LessonController::class, 'store'])->name('admin.courses.lessons.store');


    Route::get('/lessons/{lesson}/edit', [\App\Http\Controllers\Admin\LessonController::class, 'edit'])->name('admin.lessons.edit');
    Route::put('/lessons/{lesson}', [\App\Http\Controllers\Admin\LessonController::class, 'update'])->name('admin.lessons.update');
    Route::delete('/lessons/{lesson}', [\App\Http\Controllers\Admin\LessonController::class, 'destroy'])->name('admin.lessons.destroy');
