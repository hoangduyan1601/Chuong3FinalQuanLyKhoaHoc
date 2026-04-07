<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    /**
     * Hiển thị danh sách học viên theo từng khóa học.
     */
    public function index(Request $request)
    {
        $courses = Course::withCount('enrollments')->get();
        $selectedCourse = null;
        $students = collect();

        if ($request->filled('course_id')) {
            $selectedCourse = Course::with('students')->findOrFail($request->course_id);
            $students = $selectedCourse->students;
        }

        return view('enrollments.index', compact('courses', 'students', 'selectedCourse'));
    }

    /**
     * Hiển thị form đăng ký khóa học.
     */
    public function create()
    {
        $courses = Course::published()->get();
        return view('enrollments.create', compact('courses'));
    }

    /**
     * Xử lý đăng ký khóa học.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_name' => 'required|max:255',
            'email' => 'required|email',
        ]);

        try {
            DB::beginTransaction();

            // Tìm hoặc tạo học viên mới
            $student = Student::firstOrCreate(
                ['email' => $request->email],
                ['name' => $request->student_name]
            );

            // Kiểm tra xem đã đăng ký chưa
            $exists = Enrollment::where('course_id', $request->course_id)
                ->where('student_id', $student->id)
                ->exists();

            if ($exists) {
                return back()->with('error', 'Học viên này đã đăng ký khóa học này rồi!');
            }

            // Tạo đăng ký mới
            Enrollment::create([
                'course_id' => $request->course_id,
                'student_id' => $student->id
            ]);

            DB::commit();
            return redirect()->route('enrollments.index', ['course_id' => $request->course_id])
                ->with('success', 'Đăng ký khóa học thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
