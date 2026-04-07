<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'student_id',
    ];

    /**
     * Quan hệ N-1 với Course
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Quan hệ N-1 với Student
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
