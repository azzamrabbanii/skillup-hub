<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseApiController extends Controller
{

    public function index()
    {

        $courses = Course::with(['category', 'teacher'])->get();


        return response()->json([
            'message' => 'List of Courses retrieved successfully',
            'data' => $courses
        ], 200);
    }

   
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
