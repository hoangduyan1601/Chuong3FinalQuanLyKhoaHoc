@extends('layouts.master')

@section('content')
<div class="mb-5">
    <a href="{{ route('lessons.index') }}" class="btn btn-outline-gold mb-4 btn-sm">
        <i class="bi bi-arrow-left me-2"></i> Quay lại danh sách bài giảng
    </a>
    <h1 class="display-5">THÊM BÀI GIẢNG TINH ANH</h1>
    <p class="text-muted text-uppercase small" style="letter-spacing: 3px;">Kiến tạo nội dung tri thức chuyên sâu</p>
</div>

<div class="card-luxury p-5 mb-5 shadow-lg">
    <form action="{{ route('lessons.store') }}" method="POST">
        @csrf
        
        <div class="row g-4">
            <div class="col-md-8">
                <div class="mb-4">
                    <label class="form-label text-uppercase small fw-bold mb-2" style="color: var(--gold-soft); letter-spacing: 1px;">Chọn khóa học sở hữu</label>
                    <select name="course_id" class="form-select form-select-lg @error('course_id') is-invalid @enderror">
                        <option value="">-- Chọn khóa học --</option>
                        @foreach($courses as $c)
                            <option value="{{ $c->id }}" {{ old('course_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase small fw-bold mb-2" style="color: var(--gold-soft); letter-spacing: 1px;">Tiêu đề bài giảng</label>
                    <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="VD: Khởi đầu sự nghiệp với Laravel">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="form-label text-uppercase small fw-bold mb-2" style="color: var(--gold-soft); letter-spacing: 1px;">Nội dung chi tiết</label>
                    <textarea name="content" rows="6" class="form-control @error('content') is-invalid @enderror" placeholder="Mô tả nội dung bài giảng...">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-4">
                    <label class="form-label text-uppercase small fw-bold mb-2" style="color: var(--gold-soft); letter-spacing: 1px;">Video URL (YouTube/Vimeo)</label>
                    <input type="url" name="video_url" class="form-control @error('video_url') is-invalid @enderror" value="{{ old('video_url') }}" placeholder="https://youtube.com/...">
                    @error('video_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase small fw-bold mb-2" style="color: var(--gold-soft); letter-spacing: 1px;">Thứ tự bài học (#)</label>
                    <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 1) }}">
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="card bg-dark border-secondary p-4 mt-5">
                    <p class="small text-muted mb-0 fst-italic">
                        <i class="bi bi-info-circle me-1"></i> Bài học sẽ được sắp xếp theo số thứ tự bạn đã nhập trong lộ trình khóa học.
                    </p>
                </div>
            </div>

            <div class="col-12 mt-5 text-end">
                <button type="submit" class="btn btn-gold px-5 py-3 fs-5">Xuất bản bài giảng</button>
            </div>
        </div>
    </form>
</div>
@endsection
