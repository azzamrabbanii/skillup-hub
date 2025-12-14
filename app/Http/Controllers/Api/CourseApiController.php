<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseApiController extends Controller
{
    // Endpoint: GET /api/courses
    public function index()
    {
        // Mengambil data kursus beserta kategori dan pengajarnya
        $courses = Course::with(['category', 'teacher'])->get();

        // Kembalikan dalam format JSON
        return response()->json([
            'message' => 'List of Courses retrieved successfully',
            'data' => $courses
        ], 200);
    }

    // Endpoint: GET /api/courses/{id}
    public function show($id)
    {
        $course = Course::with(['category', 'teacher', 'lessons'])->find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        return response()->json([
            'message' => 'Course detail retrieved successfully',
            'data' => $course
        ], 200);
    }
}
