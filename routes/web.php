<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;

// Dashboard
Route::get('/', [CourseController::class, 'dashboard'])->name('dashboard');

// Quản lý khóa học
Route::post('courses/{id}/restore', [CourseController::class, 'restore'])->name('courses.restore');
Route::resource('courses', CourseController::class);

// Quản lý bài học
Route::resource('lessons', LessonController::class);

// Quản lý đăng ký
Route::resource('enrollments', EnrollmentController::class);
