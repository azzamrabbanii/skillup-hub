<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;

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
