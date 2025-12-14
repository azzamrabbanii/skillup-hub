<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // READ: Tampilkan daftar kategori
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    // CREATE: Tampilkan form tambah
    public function create()
    {
        return view('admin.categories.create');
    }

    // STORE: Proses simpan data
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        // Upload Icon
        $iconPath = $request->file('icon')->store('category_icons', 'public');

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $iconPath,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    // EDIT: Tampilkan form edit
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // UPDATE: Proses update data
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ];

        // Cek apakah user upload icon baru
        if ($request->hasFile('icon')) {
            // Hapus icon lama biar hemat storage
            if ($category->icon && Storage::exists($category->icon)) {
                Storage::delete($category->icon);
            }
            $data['icon'] = $request->file('icon')->store('category_icons', 'public');
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    // DELETE: Hapus data
    public function destroy(Category $category)
    {
        // Hapus file gambarnya juga
        if ($category->icon && Storage::exists($category->icon)) {
            Storage::delete($category->icon);
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
}
