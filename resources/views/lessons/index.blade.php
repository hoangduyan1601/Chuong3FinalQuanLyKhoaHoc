@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h1 class="display-5">QUẢN LÝ BÀI GIẢNG</h1>
        <p class="text-muted text-uppercase small" style="letter-spacing: 3px;">Kiến tạo lộ trình tri thức đẳng cấp</p>
    </div>
    <a href="{{ route('lessons.create') }}" class="btn btn-gold">
        <i class="bi bi-plus-lg me-2"></i> Thêm bài học mới
    </a>
</div>

<div class="card-luxury p-4 mb-5">
    <form action="{{ route('lessons.index') }}" method="GET" class="row g-3">
        <div class="col-md-6">
            <label for="course_id" class="form-label text-uppercase small fw-bold" style="color: var(--gold-soft); letter-spacing: 1px;">Chọn khóa học để hiển thị lộ trình</label>
            <select name="course_id" id="course_id" class="form-select" onchange="this.form.submit()">
                <option value="">-- Chọn khóa học tinh hoa --</option>
                @foreach($allCourses as $c)
                    <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected' : '' }}>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>
</div>

@if($selectedCourse)
    <div class="mb-4">
        <h3 class="luxury-font">Lộ trình: {{ $selectedCourse->name }}</h3>
    </div>
    
    <div class="card-luxury overflow-hidden shadow-lg">
        <div class="table-responsive">
            <table class="table mb-0 align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">Thứ tự</th>
                        <th>Tiêu đề bài giảng</th>
                        <th>Video học tập</th>
                        <th>Ngày tạo</th>
                        <th class="text-end pe-4">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lessons as $lesson)
                    <tr>
                        <td class="ps-4">
                            <span class="badge bg-dark border border-warning text-warning px-3 py-2" style="font-size: 1rem;">
                                #{{ $lesson->order }}
                            </span>
                        </td>
                        <td class="fw-bold fs-5" style="color: #fff;">{{ $lesson->title }}</td>
                        <td>
                            <a href="{{ $lesson->video_url }}" target="_blank" class="btn btn-sm btn-outline-gold px-3">
                                <i class="bi bi-play-fill me-1"></i> Xem Video
                            </a>
                        </td>
                        <td><span class="text-muted">{{ $lesson->created_at->format('d/m/Y') }}</span></td>
                        <td class="text-end pe-4">
                            <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xóa bài giảng này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger border-danger">
                                    <i class="bi bi-trash3"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted fst-italic">Khóa học này chưa có bài giảng nào được khởi tạo.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="card-luxury p-5 text-center text-muted">
        <i class="bi bi-journal-x display-1 mb-3" style="opacity: 0.2;"></i>
        <p class="fs-4">Vui lòng chọn một khóa học để bắt đầu quản lý bài học.</p>
    </div>
@endif
@endsection
