<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseLesson;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function index(Course $course, $lessonId = null)
    {
        // 1. Ambil data kursus beserta semua materinya (urutkan berdasarkan chapter)
        $course->load(['lessons' => function($query) {
            $query->orderBy('chapter', 'asc');
        }]);

        // 2. Tentukan video mana yang mau diputar
        if ($lessonId) {
            // Jika user klik judul materi tertentu di sidebar
            $currentLesson = $course->lessons->where('id', $lessonId)->first();
        } else {
            // Jika baru masuk, putar materi pertama (Chapter 1)
            $currentLesson = $course->lessons->first();
        }

        // 3. Helper untuk Youtube ID (Karena kita simpan link full)
        $youtubeId = null;
        if ($currentLesson && $currentLesson->video_url) {
            // Regex untuk mengambil ID dari berbagai format link Youtube
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $currentLesson->video_url, $match);
            $youtubeId = isset($match[1]) ? $match[1] : null;
        }

        return view('front.learning', compact('course', 'currentLesson', 'youtubeId'));
    }
}