<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // 1. PROSES JOIN / BELI KURSUS
    public function store(Course $course)
    {
        // Cek apakah user sudah login?
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to join this course.');
        }

        $user = Auth::user();

        // Cek apakah user SUDAH pernah join kursus ini?
        // Kita cek tabel transaksi (subscribe_transactions)
        // (Asumsi: Kita belum buat Model SubscribeTransaction, jadi pakai DB Query dulu biar cepat)
        $alreadyEnrolled = DB::table('subscribe_transactions')
            ->where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->exists();

        if ($alreadyEnrolled) {
            return redirect()->route('learning.index', $course->slug)->with('success', 'You already joined this course!');
        }

        // Mulai Transaksi Database
        DB::beginTransaction();

        try {
            // Simpan data transaksi
            DB::table('subscribe_transactions')->insert([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'total_amount' => $course->price,
                'is_paid' => true, // KITA SET AUTO-LUNAS DULU (Biar langsung bisa belajar)
                'start_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            // Redirect ke Halaman Belajar (Learning Room)
            return redirect()->route('learning.index', $course->slug)->with('success', 'Successfully joined the course!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'System Error: ' . $e->getMessage());
        }
    }
}
