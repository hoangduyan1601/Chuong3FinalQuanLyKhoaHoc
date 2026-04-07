<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Hiển thị danh sách bài học theo khóa học.
     */
    public function index(Request $request)
    {
        $courses = Course::has('lessons')->with('lessons')->get();
        
        $selectedCourse = null;
        $lessons = collect();

        if ($request->filled('course_id')) {
            $selectedCourse = Course::with(['lessons' => function($q) {
                $q->orderBy('order', 'asc');
            }])->findOrFail($request->course_id);
            $lessons = $selectedCourse->lessons;
        }

        $allCourses = Course::select('id', 'name')->get();

        return view('lessons.index', compact('lessons', 'allCourses', 'selectedCourse'));
    }

    /**
     * Form thêm mới bài học.
     */
    public function create()
    {
        $courses = Course::select('id', 'name')->get();
        return view('lessons.create', compact('courses'));
    }

    /**
     * Lưu bài học mới.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|max:255',
            'order' => 'required|integer|min:0',
            'video_url' => 'nullable|url',
        ]);

        Lesson::create($request->all());

        return redirect()->route('lessons.index', ['course_id' => $request->course_id])
            ->with('success', 'Thêm bài học thành công!');
    }

    /**
     * Xóa bài học.
     */
    public function destroy(Lesson $lesson)
    {
        $courseId = $lesson->course_id;
        $lesson->delete();
        return redirect()->route('lessons.index', ['course_id' => $courseId])
            ->with('success', 'Đã xóa bài học!');
    }
}
