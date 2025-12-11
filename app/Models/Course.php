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
        //return $this->hasMany(Course::class)->where('id', 0); // Hack sementara: Return relasi kosong biar gak error
        return $this->hasMany(Course::class, 'teacher_id')->where('id', 0);
    }

    // Helper untuk mengambil ID Youtube dari Link
    public function getYoutubeIdAttribute()
    {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $this->path_trailer, $match);
        return isset($match[1]) ? $match[1] : null;
    }
}
