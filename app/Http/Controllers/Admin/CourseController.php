<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category; // <--- JANGAN LUPA INI
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        // Kita gunakan paginate agar halaman tidak berat jika data ribuan
        $courses = Course::with('category')->latest()->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    // 1. TAMPILKAN FORM TAMBAH
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori untuk dropdown
        return view('admin.courses.create', compact('categories'));
    }

    // 2. PROSES SIMPAN DATA
    public function store(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
            'price' => 'required|integer|min:0',
            'about' => 'required|string',
            'path_trailer' => 'nullable|string', // Link Youtube dsb
        ]);

        DB::beginTransaction(); // Pakai transaksi biar aman (kalau gagal, data gak masuk setengah2)

        try {
            // A. Proses Upload Gambar
            if ($request->hasFile('thumbnail')) {
                // Simpan ke folder 'thumbnails' di dalam storage public
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            // B. Tambahkan Data Tambahan Otomatis
            $validated['slug'] = Str::slug($request->name);
            $validated['teacher_id'] = Auth::id(); // Otomatis yang login jadi gurunya
            $validated['is_open'] = true; // Default dibuka

            // C. Simpan ke Database
            Course::create($validated);

            DB::commit(); // Simpan permanen

            return redirect()->route('admin.courses.index')->with('success', 'Course created successfully!');
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan jika error
            return redirect()->back()->with('error', 'System Error: ' . $e->getMessage());
        }
    }

    // TAMPILKAN FORM EDIT
    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('admin.courses.edit', compact('course', 'categories'));
    }

    // PROSES UPDATE DATA
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Nullable karena kalau gak ganti gambar, gak apa2
            'price' => 'required|integer|min:0',
            'about' => 'required|string',
            'path_trailer' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Cek apakah user upload gambar baru?
            if ($request->hasFile('thumbnail')) {
                // Hapus gambar lama (Opsional, tapi bagus buat hemat storage)
                if ($course->thumbnail) {
                    Storage::disk('public')->delete($course->thumbnail);
                }
                // Simpan gambar baru
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
