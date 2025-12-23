<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LearningController extends Controller
{
    public function index(Course $course, $lessonId = null)
    {

        $course->load(['lessons' => function ($query) {
            $query->orderBy('chapter', 'asc');
        }]);


        if ($lessonId) {
            $currentLesson = $course->lessons->where('id', $lessonId)->first();
        } else {
            $currentLesson = $course->lessons->first();
        }


        $youtubeId = null;
        if ($currentLesson && $currentLesson->video_url) {
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $currentLesson->video_url, $match);
            $youtubeId = isset($match[1]) ? $match[1] : null;
        }


        $totalLessons = $course->lessons->count();
        $completedLessons = DB::table('course_student_progress')
            ->where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->count();


        $progressPercentage = ($totalLessons > 0) ? ($completedLessons / $totalLessons) * 100 : 0;
        return view('front.learning', compact('course', 'currentLesson', 'youtubeId', 'progressPercentage'));
    }
}
