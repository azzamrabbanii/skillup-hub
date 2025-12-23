<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseLesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{

    public function index(Course $course)
    {
        $lessons = $course->lessons()->orderBy('chapter', 'asc')->get();
        return view('admin.lessons.index', compact('lessons', 'course'));
    }

    public function create(Course $course)
    {
        return view('admin.lessons.create', compact('course'));
    }


    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'video_url' => 'required|string',
            'chapter' => 'required|integer',
        ]);

        $validated['course_id'] = $course->id;

        CourseLesson::create($validated);

        return redirect()->route('admin.courses.lessons.index', $course->id)
            ->with('success', 'Lesson created successfully!');
    }


    public function edit(CourseLesson $lesson)
    {

        $course = $lesson->course;
        return view('admin.lessons.edit', compact('lesson', 'course'));
    }


    public function update(Request $request, CourseLesson $lesson)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'video_url' => 'required|string',
            'chapter' => 'required|integer',
        ]);

        $lesson->update($validated);

        return redirect()->route('admin.courses.lessons.index', $lesson->course_id)
            ->with('success', 'Lesson updated successfully!');
    }

   
    public function destroy(CourseLesson $lesson)
    {
        $courseId = $lesson->course_id;
        $lesson->delete();

        return redirect()->route('admin.courses.lessons.index', $courseId)
            ->with('success', 'Lesson deleted successfully!');
    }
}
