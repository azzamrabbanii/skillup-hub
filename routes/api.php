<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseApiController;


Route::get('/courses', [CourseApiController::class, 'index']);
Route::get('/courses/{id}', [CourseApiController::class, 'show']);
