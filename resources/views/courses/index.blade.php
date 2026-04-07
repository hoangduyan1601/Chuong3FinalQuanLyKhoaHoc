@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h1 class="display-5">BỘ SƯU TẬP KHÓA HỌC</h1>
        <p class="text-muted text-uppercase small" style="letter-spacing: 3px;">Quản lý những giá trị tri thức tinh túy nhất</p>
    </div>
    <a href="{{ route('courses.create') }}" class="btn btn-gold">
        <i class="bi bi-plus-lg me-2"></i> Khởi tạo khóa học
    </a>
</div>

<!-- Luxury Filter Section -->
<div class="card-luxury p-4 mb-5">
    <form action="{{ route('courses.index') }}" method="GET" class="row g-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm tên khóa học..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">-- Mọi trạng thái --</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Đã công bố</option>
            </select>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <input type="number" name="min_price" class="form-control" placeholder="Giá từ" value="{{ request('min_price') }}">
                <input type="number" name="max_price" class="form-control" placeholder="đến" value="{{ request('max_price') }}">
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-gold w-100">Lọc kết quả</button>
        </div>
    </form>
</div>

<!-- Table Section -->
<div class="card-luxury overflow-hidden">
    <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead>
                <tr>
                    <th class="ps-4">Nhận diện</th>
                    <th>Kiến thức tinh hoa</th>
                    <th>Giá trị đầu tư</th>
                    <th>Quy mô bài giảng</th>
                    <th>Cộng đồng học viên</th>
                    <th>Trạng thái</th>
                    <th class="text-end pe-4">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                <tr>
                    <td class="ps-4">
                        @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" width="60" class="rounded-3 border border-secondary shadow-sm">
                        @else
                            <div class="bg-secondary rounded-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; opacity: 0.3;">
                                <i class="bi bi-image text-white"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="fw-bold fs-5" style="color: var(--gold-soft);">{{ $course->name }}</div>
                        <div class="small text-muted">{{ Str::limit($course->description, 50) }}</div>
                    </td>
                    <td><span class="fs-6 fw-semibold">{{ number_format($course->price) }} VNĐ</span></td>
                    <td><span class="badge rounded-pill bg-dark border border-secondary px-3">{{ $course->lessons_count }} bài giảng</span></td>
                    <td><i class="bi bi-people-fill me-1 text-muted"></i> {{ $course->enrollments->count() }} học viên</td>
                    <td><x-badge :status="$course->status" /></td>
                    <td class="text-end pe-4">
                        <div class="btn-group shadow-sm">
                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-outline-gold">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn đưa khóa học này vào lịch sử xóa?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger border-danger">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted fst-italic">Hiện chưa có tinh hoa kiến thức nào được khởi tạo.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 luxury-pagination">
    {{ $courses->links() }}
</div>
@endsection
