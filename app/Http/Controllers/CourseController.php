<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Hiển thị danh sách khóa học với lọc và phân trang.
     */
    public function index(Request $request)
    {
        $query = Course::query()
            ->with(['lessons', 'enrollments']) // Eager Loading tránh N+1
            ->withCount('lessons'); // Đếm số lượng bài học

        // Tìm kiếm theo tên
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Lọc theo khoảng giá
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->priceBetween($request->min_price, $request->max_price);
        }

        // Sắp xếp
        $sortField = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortField, $sortOrder);

        $courses = $query->paginate(10)->withQueryString();

        return view('courses.index', compact('courses'));
    }

    /**
     * Hiển thị form tạo mới.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Lưu khóa học mới.
     */
    public function store(CourseRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name) . '-' . time();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($data);

        return redirect()->route('courses.index')->with('success', 'Thêm khóa học mới thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Cập nhật thông tin khóa học.
     */
    public function update(CourseRequest $request, Course $course)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name) . '-' . $course->id;

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($data);

        return redirect()->route('courses.index')->with('success', 'Cập nhật khóa học thành công!');
    }

    /**
     * Xóa mềm khóa học.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Đã xóa khóa học vào thùng rác!');
    }

    /**
     * Khôi phục khóa học từ thùng rác.
     */
    public function restore($id)
    {
        $course = Course::onlyTrashed()->findOrFail($id);
        $course->restore();
        return redirect()->route('courses.index')->with('success', 'Khôi phục khóa học thành công!');
    }

    /**
     * Dashboard thống kê dữ liệu.
     */
    public function dashboard()
    {
        $totalCourses = Course::count();
        $totalStudents = Student::count();
        
        // Tính tổng doanh thu từ các khóa học đã được enroll
        $totalRevenue = Enrollment::join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->sum('courses.price');

        // Khóa học có nhiều học viên nhất
        $mostPopularCourse = Course::withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->first();

        // 5 khóa học mới nhất
        $latestCourses = Course::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalCourses', 
            'totalStudents', 
            'totalRevenue', 
            'mostPopularCourse', 
            'latestCourses'
        ));
    }
}
