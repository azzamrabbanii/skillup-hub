<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseLesson;
use Illuminate\Http\Request;
// PENTING: Import library tambahan ini untuk fitur Aman
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LearningController extends Controller
{
    public function index(Course $course, $lessonId = null)
    {
        // 1. Ambil data kursus beserta semua materinya
        $course->load(['lessons' => function ($query) {
            $query->orderBy('chapter', 'asc');
        }]);

        // 2. Tentukan video mana yang mau diputar
        if ($lessonId) {
            $currentLesson = $course->lessons->where('id', $lessonId)->first();
        } else {
            $currentLesson = $course->lessons->first();
        }

        // 3. Helper untuk Youtube ID
        $youtubeId = null;
        if ($currentLesson && $currentLesson->video_url) {
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $currentLesson->video_url, $match);
            $youtubeId = isset($match[1]) ? $match[1] : null;
        }

        // === LOGIC BARU (AMAN): HITUNG PROGRESS ===
        // Hitung total materi
        $totalLessons = $course->lessons->count();

        // Hitung berapa materi yang SUDAH ditandai 'complete' oleh user ini
        $completedLessons = DB::table('course_student_progress')
            ->where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->count();

        // Rumus Persentase (Cegah error division by zero)
        $progressPercentage = ($totalLessons > 0) ? ($completedLessons / $totalLessons) * 100 : 0;
        // ==========================================

        // Kirim variabel $progressPercentage ke View
        return view('front.learning', compact('course', 'currentLesson', 'youtubeId', 'progressPercentage'));
    }
}
