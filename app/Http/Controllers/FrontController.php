<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        // 1. Ambil 3 Kursus Terbaru yang statusnya "Open"
        // 'with' digunakan untuk mengambil data relasi (Category & Teacher) sekaligus biar cepat
        $courses = Course::with(['category', 'teacher'])
            ->where('is_open', true)
            ->latest()
            ->take(3)
            ->get();

        // (Opsional) Ambil data statistik untuk Hero Section
        // count() menghitung jumlah baris di database
        $totalCourses = Course::count();
        $totalInstructors = User::where('role', 'instructor')->count();
        $totalStudents = User::where('role', 'student')->count();

        // 2. Kirim data ke view 'welcome'
        return view('welcome', compact('courses', 'totalCourses', 'totalInstructors', 'totalStudents'));
    }
}
