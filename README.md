# ELITE COURSE MANAGEMENT SYSTEM (CMS) - LUXURY EDITION

Chào mừng bạn đến với hệ thống quản lý khóa học phiên bản **Ultra-Premium Gold**. Dự án được xây dựng trên nền tảng **Laravel 11** với kiến trúc tối ưu và giao diện doanh nghiệp đẳng cấp quốc tế.

## 🌟 Tính Năng Nổi Bật
- **Thiết kế Luxury:** Giao diện Midnight Black kết hợp Glittering Gold đạt chuẩn Enterprise.
- **Tối ưu hóa Truy vấn:** Sử dụng Eager Loading (`with`, `withCount`) triệt tiêu hoàn toàn lỗi N+1 Query.
- **Eloquent ORM:** Áp dụng 100% sức mạnh của Laravel Eloquent, Scopes và Relationships.
- **Bảo mật & Toàn vẹn:** Sử dụng Database Transactions cho các hoạt động đăng ký học viên.
- **Quản lý toàn diện:** Khóa học (Soft Delete), Bài học, Học viên & Đăng ký.

---

## 🛠 Yêu Cầu Hệ Thống
- **PHP:** >= 8.2
- **Composer:** >= 2.x
- **MySQL (XAMPP):** >= 8.0

---

## 🚀 Hướng Dẫn Cài Đặt & Chạy Project

Thực hiện tuần tự các bước sau để thiết lập dự án trên máy cục bộ của bạn:

### Bước 1: Khởi tạo Database
1. Mở XAMPP (hoặc MySQL Server của bạn).
2. Tạo một Database mới với tên: `bai3_final_qlkhoahoc`.

### Bước 2: Cài đặt Dependencies
Mở Terminal tại thư mục gốc của dự án và chạy:
```bash
composer install
```

### Bước 3: Cấu hình Môi trường
Nếu bạn chưa có file `.env`, hãy tạo mới bằng cách copy từ file ví dụ:
```bash
cp .env.example .env
```
Sau đó, hãy kiểm tra lại thông số Database trong file `.env` đảm bảo chính xác:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bai3_final_qlkhoahoc
DB_USERNAME=root
DB_PASSWORD=
```

### Bước 4: Tạo Key ứng dụng
```bash
php artisan key:generate
```

### Bước 5: Chạy Migration & Seeder (Tạo bảng và Dữ liệu mẫu)
Lệnh này sẽ tạo toàn bộ cấu trúc bảng và đổ dữ liệu mẫu chuyên nghiệp vào hệ thống:
```bash
php artisan migrate:fresh --seed
```

### Bước 6: Tạo liên kết thư mục Storage (Để hiển thị ảnh)
```bash
php artisan storage:link
```

### Bước 7: Khởi động Server
Chạy lệnh cuối cùng để bắt đầu trải nghiệm:
```bash
php artisan serve
```
Truy cập địa chỉ: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 📸 Hướng Dẫn Báo Cáo / Chụp Ảnh
Hệ thống đã được thiết kế tối ưu cho việc chụp ảnh minh họa:
1. **Dashboard:** Thống kê tổng quan sang trọng.
2. **Courses:** Danh sách khóa học với bộ lọc cao cấp.
3. **Lessons:** Quản lý bài học theo từng khóa chuyên sâu.
4. **Enrollments:** Quản lý danh sách học viên đăng ký.

---

## 🛡️ Tác giả
Dự án được thực hiện bởi **Senior Laravel Developer**. Mọi thắc mắc vui lòng liên hệ đội ngũ kỹ thuật.
