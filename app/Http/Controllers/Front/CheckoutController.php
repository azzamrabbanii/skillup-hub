<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{

    public function store(Course $course)
    {

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to join this course.');
        }

        $user = Auth::user();


        $alreadyEnrolled = DB::table('subscribe_transactions')
            ->where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->exists();

        if ($alreadyEnrolled) {
            return redirect()->route('learning.index', $course->slug)->with('success', 'You already joined this course!');
        }


        DB::beginTransaction();

        try {

            DB::table('subscribe_transactions')->insert([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'total_amount' => $course->price,
                'is_paid' => true,
                'start_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            
            return redirect()->route('learning.index', $course->slug)->with('success', 'Successfully joined the course!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'System Error: ' . $e->getMessage());
        }
    }
}
