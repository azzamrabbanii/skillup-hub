<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')->latest()->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.courses.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|integer|min:0',
            'about' => 'required|string',
            'path_trailer' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $validated['slug'] = Str::slug($request->name);
            $validated['teacher_id'] = Auth::id();
            $validated['is_open'] = true;

            Course::create($validated);

            DB::commit();
            return redirect()->route('admin.courses.index')->with('success', 'Course created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'System Error: ' . $e->getMessage());
        }
    }


    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('admin.courses.edit', compact('course', 'categories'));
    }


    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|integer|min:0',
            'about' => 'required|string',
            'path_trailer' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {

            if ($request->hasFile('thumbnail')) {

                if ($course->thumbnail) {
                    Storage::disk('public')->delete($course->thumbnail);
                }
                
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $validated['slug'] = Str::slug($request->name);

            $course->update($validated);

            DB::commit();
            return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'System Error: ' . $e->getMessage());
        }
    }

    public function destroy(Course $course)
    {
        DB::beginTransaction();
        try {
            $course->delete(); // Ini soft delete (data gak hilang permanen, cuma disembunyikan)
            DB::commit();
            return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
