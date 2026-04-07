<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tạo 5 khóa học
        $courses = [
            ['name' => 'Laravel Pro 2024', 'price' => 1500000, 'status' => 'published'],
            ['name' => 'React Native Mobile', 'price' => 2200000, 'status' => 'published'],
            ['name' => 'Python for AI', 'price' => 3000000, 'status' => 'published'],
            ['name' => 'PHP Basic to Advanced', 'price' => 800000, 'status' => 'draft'],
            ['name' => 'VueJS Masterclass', 'price' => 1200000, 'status' => 'published'],
        ];

        foreach ($courses as $c) {
            $course = Course::create([
                'name' => $c['name'],
                'slug' => Str::slug($c['name']) . '-' . rand(100, 999),
                'price' => $c['price'],
                'description' => 'Mô tả cho khóa học ' . $c['name'],
                'status' => $c['status'],
            ]);

            // 2. Mỗi khóa học tạo 3 bài học
            for ($i = 1; $i <= 3; $i++) {
                Lesson::create([
                    'course_id' => $course->id,
                    'title' => 'Bài học số ' . $i . ' của ' . $course->name,
                    'content' => 'Nội dung bài học...',
                    'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'order' => $i
                ]);
            }
        }

        // 3. Tạo 10 học viên và đăng ký ngẫu nhiên
        for ($j = 1; $j <= 10; $j++) {
            $student = Student::create([
                'name' => 'Học viên ' . $j,
                'email' => 'student' . $j . '@example.com'
            ]);

            // Đăng ký vào 1-2 khóa học ngẫu nhiên
            $randomCourses = Course::where('status', 'published')->inRandomOrder()->take(rand(1, 2))->get();
            foreach ($randomCourses as $rc) {
                Enrollment::create([
                    'course_id' => $rc->id,
                    'student_id' => $student->id
                ]);
            }
        }
    }
}
