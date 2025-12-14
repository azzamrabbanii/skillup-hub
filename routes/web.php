<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\Admin\UserController;

// --- PUBLIC ROUTES ---
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');
Route::get('/', [FrontController::class, 'index'])->name('home');
// Route Detail Kursus (Menggunakan Slug)
// Pastikan di Model Course, 'slug' unik agar tidak bentrok
Route::get('/course/{course:slug}', [FrontController::class, 'details'])->name('front.details');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// --- ADMIN ROUTES (Hanya Admin yang bisa akses) ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // Dashboard Utama
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // <--- Ubah bagian ini
    })->name('admin.dashboard');

    // Nanti rute CRUD Course, Category, User akan ditambahkan di sini...
    // === TAMBAHAN BARU: COURSE MANAGEMENT ===
    // Menggunakan resource agar otomatis dapat index, create, store, edit, update, destroy
    Route::resource('courses', \App\Http\Controllers\Admin\CourseController::class)
        ->names('admin.courses');
    // ->names ini memberi awalan nama route jadi 'admin.courses.index', 'admin.courses.create', dst.
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)
        ->only(['index', 'destroy'])
        ->names('admin.users'); // <--- INI KUNCI PERBAIKANNYA
});

// --- INSTRUCTOR ROUTES (Hanya Instructor yang bisa akses) ---
Route::middleware(['auth', 'role:instructor'])->prefix('instructor')->group(function () {

    Route::get('/dashboard', function () {
        return "<h1>Ini Halaman Dashboard INSTRUCTOR</h1>"; // Nanti diganti View Instructor
    })->name('instructor.dashboard');
});

// --- STUDENT ROUTES (Hanya Student yang bisa akses) ---
Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('/my-courses', function () {
        return "<h1>Ini Halaman Kursus Saya (Student)</h1>";
    })->name('student.dashboard');
});

// --- STUDENT / AUTHENTICATED ROUTES ---
Route::middleware(['auth', 'role:student|admin|instructor'])->group(function () {

    // 1. Route untuk Checkout (Join Course)
    Route::post('/course/{course:slug}/join', [\App\Http\Controllers\Front\CheckoutController::class, 'store'])->name('front.checkout.store');

    // === AMAN'S FEATURE: PROGRESS ===
    Route::post('/learning/{course:slug}/{lesson}/complete', [\App\Http\Controllers\Front\CourseProgressController::class, 'markAsComplete'])
        ->name('learning.complete');

    Route::get('/learning/{course:slug}/certificate', [\App\Http\Controllers\Front\CourseProgressController::class, 'downloadCertificate'])
        ->name('learning.certificate');

    // 2. Route Halaman Belajar (Learning Room) - Nanti ini tugas Maya/Azzam
    // KODE BARU (PAKAI INI)
    // Pastikan di paling atas file sudah ada: use App\Http\Controllers\Front\LearningController;
    Route::get('/learning/{course:slug}', [\App\Http\Controllers\Front\LearningController::class, 'index'])->name('learning.index');
    Route::get('/learning/{course:slug}/{lesson}', [\App\Http\Controllers\Front\LearningController::class, 'index'])->name('learning.show');

    // Fitur Nicholas: Edit Profile
    Route::get('/profile', [\App\Http\Controllers\Front\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Front\ProfileController::class, 'update'])->name('profile.update');

    // === FITUR ARKANANTHA: CATEGORY MANAGEMENT ===
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)
        ->names('admin.categories');
});

// === FITUR MAYA: LESSON MANAGEMENT ===

    // Lihat Daftar Lesson & Form Create (Butuh ID Course)
    Route::get('/courses/{course}/lessons', [\App\Http\Controllers\Admin\LessonController::class, 'index'])->name('admin.courses.lessons.index');
    Route::get('/courses/{course}/lessons/create', [\App\Http\Controllers\Admin\LessonController::class, 'create'])->name('admin.courses.lessons.create');
    Route::post('/courses/{course}/lessons', [\App\Http\Controllers\Admin\LessonController::class, 'store'])->name('admin.courses.lessons.store');

    // Edit & Delete Lesson (Butuh ID Lesson saja)
    Route::get('/lessons/{lesson}/edit', [\App\Http\Controllers\Admin\LessonController::class, 'edit'])->name('admin.lessons.edit');
    Route::put('/lessons/{lesson}', [\App\Http\Controllers\Admin\LessonController::class, 'update'])->name('admin.lessons.update');
    Route::delete('/lessons/{lesson}', [\App\Http\Controllers\Admin\LessonController::class, 'destroy'])->name('admin.lessons.destroy');
