<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'image',
        'status',
    ];

    /**
     * Quan hệ 1-N với Lesson
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * Quan hệ 1-N với Enrollment
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Quan hệ Many-to-Many với Student thông qua Enrollment
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments')->withTimestamps();
    }

    /**
     * Scope lọc các khóa học đã xuất bản
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope lọc theo khoảng giá
     */
    public function scopePriceBetween($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }
}
