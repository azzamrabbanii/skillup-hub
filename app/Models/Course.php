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
        'category_id',
        'teacher_id',
    ];


    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function lessons()
    {
        return $this->hasMany(CourseLesson::class);

    }

    
    public function getYoutubeIdAttribute()
    {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $this->path_trailer, $match);
        return isset($match[1]) ? $match[1] : null;
    }
}
