@extends('layouts.master')

@section('content')
<div class="mb-5">
    <a href="{{ route('courses.index') }}" class="btn btn-outline-gold mb-4 btn-sm">
        <i class="bi bi-arrow-left me-2"></i> Quay lại bộ sưu tập
    </a>
    <h1 class="display-5">HIỆU CHỈNH TINH HOA: {{ $course->name }}</h1>
    <p class="text-muted text-uppercase small" style="letter-spacing: 3px;">Cập nhật những giá trị tri thức mới nhất</p>
</div>

<div class="card-luxury p-5 mb-5 shadow-lg" style="background: rgba(255, 255, 255, 0.05);">
    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row g-4">
            <div class="col-md-8">
                <div class="mb-4">
                    <label class="form-label text-uppercase small fw-bold mb-2" style="color: #FFFFFF; letter-spacing: 1px;">Tên khóa học vinh dự</label>
                    <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name', $course->name) }}" style="background: rgba(0, 0, 0, 0.2) !important; color: #fff !important;" placeholder="VD: Nghệ thuật đàm phán tối cao">
                    @error('name')
                        <div class="invalid-feedback" style="color: #ff4d4d !important;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="form-label text-uppercase small fw-bold mb-2" style="color: #FFFFFF; letter-spacing: 1px;">Sơ lược nội dung</label>
                    <textarea name="description" rows="6" class="form-control @error('description') is-invalid @enderror" style="background: rgba(0, 0, 0, 0.2) !important; color: #fff !important;" placeholder="Mô tả sự đẳng cấp của khóa học này...">{{ old('description', $course->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback" style="color: #ff4d4d !important;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4 mb-4" style="background: rgba(0, 0, 0, 0.3); border: 1px dashed var(--glass-border); border-radius: 15px;">
                    <label class="form-label text-uppercase small fw-bold mb-3 d-block text-center" style="color: #FFFFFF;">Biểu tượng khóa học</label>
                    @if($course->image)
                        <div class="text-center mb-3">
                            <img src="{{ asset('storage/' . $course->image) }}" width="150" class="rounded border border-secondary shadow-sm">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" style="background: rgba(255, 255, 255, 0.1) !important; color: #fff !important;">
                    @error('image')
                        <div class="invalid-feedback" style="color: #ff4d4d !important;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase small fw-bold mb-2" style="color: #FFFFFF;">Giá trị đầu tư (VNĐ)</label>
                    <input type="number" name="price" class="form-control form-control-lg @error('price') is-invalid @enderror" value="{{ old('price', $course->price) }}" style="background: rgba(0, 0, 0, 0.2) !important; color: #fff !important;" placeholder="0.00">
                    @error('price')
                        <div class="invalid-feedback" style="color: #ff4d4d !important;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase small fw-bold mb-2" style="color: #FFFFFF;">Trạng thái hiển thị</label>
                    <select name="status" class="form-select form-select-lg @error('status') is-invalid @enderror" style="background: rgba(0, 0, 0, 0.2) !important; color: #fff !important;">
                        <option value="draft" {{ old('status', $course->status) == 'draft' ? 'selected' : '' }} style="background: #1a1a1a;">Bản nháp riêng tư</option>
                        <option value="published" {{ old('status', $course->status) == 'published' ? 'selected' : '' }} style="background: #1a1a1a;">Công bố toàn cầu</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback" style="color: #ff4d4d !important;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 mt-5">
                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary px-5">Hủy bỏ</a>
                    <button type="submit" class="btn btn-gold px-5 py-3 fs-5">Cập nhật khóa học</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
