<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'path_trailer',
        'about',
        'thumbnail',
        'price',
        'is_open',
        'category_id', // Foreign Key
        'teacher_id',  // Foreign Key
    ];

    // Relasi ke User (Pembuat Kursus / Guru)
    // Kita namakan fungsinya 'teacher' biar jelas, tapi class-nya tetap User
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Relasi ke Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke Lessons (Materi) - Punya Maya
    public function lessons()
    {
        //return $this->hasMany(CourseLesson::class);
    }
}
