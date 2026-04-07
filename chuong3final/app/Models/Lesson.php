<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['course_id', 'title', 'content', 'video_url', 'order'];

    // Thuộc về 1 Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}