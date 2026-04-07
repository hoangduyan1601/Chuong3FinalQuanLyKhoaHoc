# THÔNG TIN DỰ ÁN
- Tên dự án: Course Management System (Hệ thống quản lý khóa học)
- Công nghệ: Laravel, PHP, MySQL (XAMPP), Bootstrap 5 (cho Frontend).
- Vai trò của bạn (AI): Bạn là một Senior Laravel Developer. Nhiệm vụ của bạn là đọc toàn bộ tài liệu này và sinh ra mã nguồn (code) hoàn chỉnh, chính xác để tôi đưa vào dự án. 
- Yêu cầu cốt lõi: Sử dụng Eloquent ORM 100% (không dùng SQL thuần), giải quyết triệt để lỗi N+1 Query bằng Eager Loading, áp dụng Repository Pattern (nếu cần) hoặc viết logic sạch trong Controller.

Hãy thực hiện tuần tự các bước sau, viết code đầy đủ cho từng bước:

## BƯỚC 1: KHỞI TẠO CẤU TRÚC
Tạo ra các câu lệnh `php artisan` để tạo toàn bộ:
- Models kèm Migrations & Controllers (Resource): Course, Lesson, Student, Enrollment.
- FormRequest: CourseRequest.

## BƯỚC 2: DATABASE & MIGRATIONS
Tên database : b3_final_qlkhoahoc
Viết code cho các file Migrations vừa tạo:
1. `courses`: id, name, slug (unique, tự sinh từ name), price (decimal), description (text), image (string), status (enum: 'draft', 'published'), softDeletes, timestamps.
2. `lessons`: id, course_id (foreign key tham chiếu courses), title, content (text), video_url, order (integer), timestamps.
3. `students`: id, name, email (unique), timestamps.
4. `enrollments`: id, course_id, student_id, timestamps.
(Đảm bảo các khóa ngoại cascade on delete/update hợp lý).

## BƯỚC 3: MODELS & RELATIONSHIPS
Viết code cho các Models. Bắt buộc khai báo `$fillable`.
1. **Course**: 
   - Dùng trait `SoftDeletes`.
   - Quan hệ: `hasMany` (lessons, enrollments).
   - Scopes: `scopePublished()` (where status = 'published'), `scopePriceBetween($query, $min, $max)`.
2. **Lesson**: Quan hệ `belongsTo` (course).
3. **Student**: Quan hệ `hasMany` (enrollments).
4. **Enrollment**: Quan hệ `belongsTo` (course, student).

## BƯỚC 4: FORM REQUEST & VALIDATION
Viết code cho `CourseRequest.php`:
- Rules: name (required), price (required, numeric, > 0), image (nullable, image, mimes).
- Trả về thông báo lỗi bằng tiếng Việt trong hàm `messages()`.

## BƯỚC 5: CONTROLLERS & OPTIMIZATION
Viết code cho `CourseController.php`:
- `index()`: Lấy danh sách khóa học, phân trang (10 item/trang). BẮT BUỘC dùng `with(['lessons', 'enrollments'])` để tránh N+1. Thêm đếm số lượng bài học (`withCount('lessons')`). Nhận params từ request để lọc (theo trạng thái, khoảng giá) và sắp xếp.
- `create()` & `store()`: Hiển thị form và lưu dữ liệu (sử dụng CourseRequest, có xử lý upload file ảnh vào thư mục public/storage).
- `edit()` & `update()`: Sửa thông tin.
- `destroy()`: Xóa mềm (Soft Delete).
- `dashboard()`: (Tạo thêm method này) Tính toán và trả về views: Tổng số khóa học, tổng học viên, tổng doanh thu (sum price của các khóa học đã enroll), khóa học có nhiều học viên nhất, 5 khóa học mới nhất.

## BƯỚC 6: VIEWS & COMPONENTS (BLADE)
Sử dụng Bootstrap 5 CDN. Viết cấu trúc HTML/Blade:
1. `layouts/master.blade.php`: Có Sidebar chứa menu (Dashboard, Courses, Lessons, Enrollments), và phần content chính.
2. Các Blade Components: 
   - `components/alert.blade.php`: Hiển thị session flash messages (success, error).
   - `components/badge.blade.php`: Truyền vào status, render badge màu xám cho draft, màu xanh lá cho published.
3. `courses/index.blade.php`: Bảng hiển thị danh sách khóa học, có form tìm kiếm/lọc ở trên. Sử dụng các component vừa tạo.
4. `courses/create.blade.php`: Form thêm mới khóa học, hiển thị lỗi validation dưới mỗi input.
5. `dashboard.blade.php`: Hiển thị các thẻ thống kê tổng quan.

Lưu ý: Hãy đưa ra code cho từng file một cách rõ ràng kèm đường dẫn file tương ứng để tôi dễ dàng copy/paste vào dự án.