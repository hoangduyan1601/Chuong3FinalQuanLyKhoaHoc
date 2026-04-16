@extends('layouts.master')

@section('content')
<div class="mb-5">
    <h1 class="display-4 fw-black">HỆ THỐNG QUẢN TRỊ <br> <span style="font-size: 1.5rem; text-transform: uppercase; letter-spacing: 5px;">Elite Experience</span></h1>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card-luxury p-4 text-center">
            <div class="mb-3">
                <i class="bi bi-book-half fs-1" style="color: #FFFFFF;"></i>
            </div>
            <h6 class="text-uppercase small mb-2" style="letter-spacing: 2px;">Tổng khóa học</h6>
            <h2 class="display-5 fw-bold luxury-font mb-0">{{ $totalCourses }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-luxury p-4 text-center">
            <div class="mb-3">
                <i class="bi bi-people-fill fs-1" style="color: #FFFFFF;"></i>
            </div>
            <h6 class="text-uppercase small mb-2" style="letter-spacing: 2px;">Tổng học viên</h6>
            <h2 class="display-5 fw-bold luxury-font mb-0">{{ $totalStudents }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-luxury p-4 text-center">
            <div class="mb-3">
                <i class="bi bi-bank fs-1" style="color: #FFFFFF;"></i>
            </div>
            <h6 class="text-uppercase small mb-2" style="letter-spacing: 2px;">Tổng doanh thu</h6>
            <h2 class="display-5 fw-bold luxury-font mb-0">{{ number_format($totalRevenue) }}đ</h2>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-7">
        <div class="card-luxury h-100 overflow-hidden">
            <div class="p-4 border-bottom border-secondary d-flex justify-content-between align-items-center">
                <h4 class="luxury-font mb-0">Khóa học mới nhất</h4>
                <a href="{{ route('courses.index') }}" class="btn btn-outline-gold btn-sm">Xem tất cả</a>
            </div>
            <div class="p-0">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead>
                            <tr>
                                <th>Khóa học</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestCourses as $course)
                            <tr>
                                <td>{{ $course->name }}</td>
                                <td>{{ number_format($course->price) }}đ</td>
                                <td><x-badge :status="$course->status" /></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card-luxury h-100 p-4 d-flex flex-column justify-content-center text-center">
            <h5 class="text-uppercase mb-4" style="letter-spacing: 3px; color: #FFFFFF;">Khóa học nổi bật</h5>
            @if($mostPopularCourse)
                <h2 class="luxury-font mb-3">{{ $mostPopularCourse->name }}</h2>
                <div class="fs-4 mb-4">
                    <span class="fw-bold" style="color: #fff;">{{ $mostPopularCourse->enrollments_count }}</span> 
                    <span class="small text-muted">Học viên tin dùng</span>
                </div>
                <div>
                    <a href="{{ route('courses.edit', $mostPopularCourse->id) }}" class="btn btn-gold">Xem chi tiết</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
