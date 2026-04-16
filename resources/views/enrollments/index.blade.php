@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h1 class="display-5">QUẢN LÝ DANH SÁCH ĐĂNG KÝ</h1>
        <p class="text-muted text-uppercase small" style="letter-spacing: 3px;">Theo dõi sự phát triển của cộng đồng tri thức</p>
    </div>
    <a href="{{ route('enrollments.create') }}" class="btn btn-gold">
        <i class="bi bi-person-plus-fill me-2"></i> Đăng ký học viên mới
    </a>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card-luxury overflow-hidden h-100 shadow-lg">
            <div class="p-4 border-bottom border-secondary text-center">
                <h5 class="luxury-font mb-0">Thống kê theo khóa</h5>
            </div>
            <div class="p-0">
                <div class="list-group list-group-flush bg-transparent">
                    @foreach($courses as $course)
                        <a href="{{ route('enrollments.index', ['course_id' => $course->id]) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3 bg-transparent border-bottom border-secondary {{ request('course_id') == $course->id ? 'active' : '' }}"
                           style="color: var(--text-main);">
                            <span class="{{ request('course_id') == $course->id ? 'text-white fw-bold' : '' }}">{{ $course->name }}</span>
                            <span class="badge bg-dark border border-warning text-white rounded-pill">{{ $course->enrollments_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        @if($selectedCourse)
            <div class="card-luxury overflow-hidden shadow-lg">
                <div class="p-4 border-bottom border-secondary bg-dark text-center">
                    <h4 class="luxury-font mb-0">Học viên: {{ $selectedCourse->name }}</h4>
                </div>
                <div class="p-0">
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th class="ps-4">Nhận diện</th>
                                    <th>Danh tính học viên</th>
                                    <th>Thông tin liên hệ</th>
                                    <th class="text-end pe-4">Thời điểm gia nhập</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" style="width: 40px; height: 40px; border: 1px solid var(--gold-soft);">
                                                {{ substr($student->name, 0, 1) }}
                                            </div>
                                        </td>
                                        <td class="fw-bold" style="color: #FFFFFF;">{{ $student->name }}</td>
                                        <td style="color: #fff;">{{ $student->email }}</td>
                                        <td class="text-end pe-4 text-muted small">
                                            {{ $student->pivot->created_at->format('H:i - d/m/Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted fst-italic">Khóa học này chưa có học viên đăng ký.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="card-luxury p-5 text-center text-muted h-100 d-flex flex-column justify-content-center border-secondary">
                <i class="bi bi-people display-1 mb-3" style="opacity: 0.2;"></i>
                <p class="fs-4">Vui lòng chọn một khóa học ở danh sách bên trái để xem danh sách học viên tinh anh.</p>
            </div>
        @endif
    </div>
</div>
@endsection
