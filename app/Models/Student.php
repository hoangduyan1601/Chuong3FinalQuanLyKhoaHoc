<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * Quan hệ 1-N với Enrollment
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
}
