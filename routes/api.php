<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseApiController;

// --- API PUBLIC ROUTES (Bisa diakses tanpa login) ---

// 1. API Azzam (Courses)
Route::get('/courses', [CourseApiController::class, 'index']);
Route::get('/courses/{id}', [CourseApiController::class, 'show']);
