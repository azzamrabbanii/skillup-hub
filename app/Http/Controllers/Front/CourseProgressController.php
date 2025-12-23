<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class CourseProgressController extends Controller
{
    public function markAsComplete(Course $course, $lessonId)
    {
        $user = Auth::user();
        $lesson = CourseLesson::findOrFail($lessonId);


        DB::table('course_student_progress')->updateOrInsert(
            [
                'user_id' => $user->id,
                'course_id' => $course->id,
                'lesson_id' => $lesson->id,
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return redirect()->back()->with('success', 'Lesson marked as completed!');
    }

    public function downloadCertificate(Course $course)
    {
        $user = Auth::user();


        $totalLessons = $course->lessons->count();
        $completedLessons = DB::table('course_student_progress')
            ->where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->count();

        if ($completedLessons < $totalLessons) {
            return back()->with('error', 'You must complete all lessons first!');
        }


        $pdf = Pdf::loadView('front.certificate', compact('user', 'course'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Certificate-' . $course->slug . '.pdf');
    }
}
