<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {

        $courses = Course::with(['category', 'teacher'])
            ->where('is_open', true)
            ->latest()
            ->take(3)
            ->get();


        $totalCourses = Course::count();
        $totalInstructors = User::where('role', 'instructor')->count();
        $totalStudents = User::where('role', 'student')->count();


        return view('welcome', compact('courses', 'totalCourses', 'totalInstructors', 'totalStudents'));
    }


    public function details(Course $course)
    {

        $course->load(['category', 'teacher']);

        return view('front.details', compact('course'));
    }
}
