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

    // ADD MATERIAL FORM
    public function create(Course $course)
    {
        return view('admin.lessons.create', compact('course'));
    }

    // 3. MATERIAL STORAGE PROCESS
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

    // MATERIAL EDIT FORM
    public function edit(CourseLesson $lesson)
    {
        // Kita butuh data course juga untuk tombol 'Back'
        $course = $lesson->course;
        return view('admin.lessons.edit', compact('lesson', 'course'));
    }

    // 5. PROSES UPDATE MATERI
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

    // 6. HAPUS MATERI
    public function destroy(CourseLesson $lesson)
    {
        $courseId = $lesson->course_id; 
        $lesson->delete();

        return redirect()->route('admin.courses.lessons.index', $courseId)
            ->with('success', 'Lesson deleted successfully!');
    }
}