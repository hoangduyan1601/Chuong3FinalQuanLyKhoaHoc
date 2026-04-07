@extends('layouts.master')

@section('content')
<div class="mb-5">
    <a href="{{ route('enrollments.index') }}" class="btn btn-outline-gold mb-4 btn-sm">
        <i class="bi bi-arrow-left me-2"></i> Quay lại danh sách đăng ký
    </a>
    <h1 class="display-5">ĐĂNG KÝ KHÓA HỌC TINH HOA</h1>
    <p class="text-muted text-uppercase small" style="letter-spacing: 3px;">Gia nhập cộng đồng tri thức đẳng cấp</p>
</div>

<div class="card-luxury p-5 mb-5 shadow-lg">
    <form action="{{ route('enrollments.store') }}" method="POST">
        @csrf
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="mb-4">
                    <label class="form-label text-uppercase small fw-bold mb-2" style="color: var(--gold-soft); letter-spacing: 1px;">Khóa học mong muốn</label>
                    <select name="course_id" class="form-select form-select-lg @error('course_id') is-invalid @enderror">
                        <option value="">-- Chọn khóa học --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }} - {{ number_format($course->price) }}đ
                            </option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase small fw-bold mb-2" style="color: var(--gold-soft); letter-spacing: 1px;">Họ và tên học viên</label>
                    <input type="text" name="student_name" class="form-control form-control-lg @error('student_name') is-invalid @enderror" value="{{ old('student_name') }}" placeholder="VD: Nguyễn Văn A">
                    @error('student_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="form-label text-uppercase small fw-bold mb-2" style="color: var(--gold-soft); letter-spacing: 1px;">Địa chỉ Email</label>
                    <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="example@gmail.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-dark border-secondary h-100 p-4 d-flex flex-column justify-content-center text-center">
                    <div class="mb-4">
                        <i class="bi bi-shield-check display-3 text-warning opacity-50"></i>
                    </div>
                    <h4 class="luxury-font mb-3">Cam kết chất lượng</h4>
                    <p class="text-muted small px-3">
                        Bằng việc đăng ký, học viên sẽ nhận được quyền truy cập trọn đời vào kho tàng tri thức và sự hỗ trợ trực tiếp từ các chuyên gia hàng đầu.
                    </p>
                    <ul class="list-unstyled text-start mx-auto mt-3 small" style="max-width: 250px;">
                        <li><i class="bi bi-check2-circle text-gold me-2"></i> Tài liệu bản quyền</li>
                        <li><i class="bi bi-check2-circle text-gold me-2"></i> Chứng nhận quốc tế</li>
                        <li><i class="bi bi-check2-circle text-gold me-2"></i> Hỗ trợ 24/7</li>
                    </ul>
                </div>
            </div>

            <div class="col-12 mt-5 text-end">
                <button type="submit" class="btn btn-gold px-5 py-3 fs-5">Hoàn tất đăng ký</button>
            </div>
        </div>
    </form>
</div>
@endsection
