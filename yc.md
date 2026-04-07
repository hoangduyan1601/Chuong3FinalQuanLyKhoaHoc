QUẢN LÝ KHÓA HỌC (COURSE MANAGEMENT SYSTEM)
1. MÔ TẢ ĐỀ BÀI
Xây dựng hệ thống quản lý khóa học trực tuyến (Course Management System).
Hệ thống cho phép:
•	Quản lý khóa học 
•	Quản lý bài học trong khóa học 
•	Quản lý học viên đăng ký 
Áp dụng:
•	Form & Request 
•	Validation 
•	Controller 
•	Eloquent ORM (quan hệ nhiều bảng + nâng cao)
2. YÊU CẦU CHỨC NĂNG
2.1. Quản lý khóa học
Thêm khóa học
Thông tin:
•	Tên khóa học 
•	Slug (tự sinh) 
•	Giá 
•	Mô tả 
•	Ảnh khóa học 
•	Trạng thái (draft / published) 
Yêu cầu:
•	Validate: 
o	required 
o	giá > 0 
•	Upload ảnh
Danh sách khóa học
Hiển thị:
•	Tên 
•	Giá 
•	Trạng thái 
•	Số bài học 
•	Ảnh 
Có:
•	Phân trang (paginate) 
•	Hiển thị số lượng bài học (count relationship)
Cập nhật khóa học
•	Cho phép sửa thông tin 
•	Hiển thị dữ liệu cũ 
Xóa khóa học
•	Soft Delete 
•	Khôi phục khóa học 
2.2. Quan hệ dữ liệu
 Quan hệ chính:
•	1 Course → nhiều Lesson 
•	1 Course → nhiều Enrollment 
•	1 Student → nhiều Enrollment 
Quan hệ trung gian:
•	Course ↔ Student = Many-to-Many (qua bảng enrollments) 
2.3. Quản lý bài học (Lesson)
Thêm bài học vào khóa học
Thông tin:
•	Tiêu đề 
•	Nội dung 
•	Video URL 
•	Thứ tự (order)
Hiển thị danh sách bài học
•	Theo từng khóa học 
•	Sắp xếp theo order 
Cập nhật / Xóa bài học
2.4. Quản lý đăng ký học (Enrollment)
Đăng ký khóa học
Form:
•	Chọn khóa học 
•	Nhập: 
o	Tên học viên 
o	Email 
Danh sách học viên
•	Hiển thị theo từng khóa 
•	Có: Tổng số học viên 
2.5. Giao diện (Blade Template)
•	Layout master 
•	Sidebar: 
o	Courses 
o	Lessons 
o	Enrollments 
•	Tách component: 
o	Alert 
o	Table 
o	Form 
2.6. Component
•	Alert thông báo 
•	Card hiển thị khóa học 
•	Badge trạng thái (draft/published) 
2.7. Dashboard
Hiển thị:
•	Tổng số khóa học 
•	Tổng số học viên 
•	Tổng doanh thu 
•	Khóa học nhiều học viên nhất 
•	5 khóa học mới 
3. YÊU CẦU NÂNG CAO
3.1. Tìm kiếm nâng cao
•	Theo: 
o	Tên khóa học 
o	Giá 
o	Trạng thái 
3.2. Lọc & sắp xếp
•	Theo: 
o	Giá 
o	Số học viên 
o	Ngày tạo 
3.3. Thống kê (ADVANCED)
•	Doanh thu theo khóa học 
•	Tổng số học viên mỗi khóa 
3.4. Tối ưu truy vấn
Bắt buộc:
with('lessons', 'enrollments')
Giải thích N+1 query
3.5. Scope
scopePublished()
scopePriceBetween()
3.6. Form Request
•	Tạo: 
php artisan make:request CourseRequest
4. CẤU TRÚC DỰ ÁN
📁 Model
•	Course 
•	Lesson 
•	Student 
•	Enrollment 
📁 Controller
•	CourseController 
•	LessonController 
•	EnrollmentController 
📁 View
•	courses/ 
•	lessons/ 
•	enrollments/ 
•	layouts/master.blade.php 
📁 Migration
•	courses 
•	lessons 
•	students 
•	enrollments 
5. YÊU CẦU KỸ THUẬT
Sinh viên phải:
•	Dùng Eloquent ORM 
•	Dùng Relationship: 
o	hasMany 
o	belongsTo 
o	belongsToMany 
•	Sử dụng: 
o	FormRequest 
o	Soft Delete 
•	Không dùng SQL thuần 
