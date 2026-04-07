<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'content',
        'video_url',
        'order',
    ];

    /**
     * Quan hệ N-1 với Course
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
