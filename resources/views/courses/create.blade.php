@extends('layouts.master')

@section('content')
<div class="mb-5">
    <a href="{{ route('courses.index') }}" class="btn btn-outline-gold mb-4 btn-sm">
        <i class="bi bi-arrow-left me-2"></i> Quay lại bộ sưu tập
    </a>
    <h1 class="display-5">KHỞI TẠO KIẾN THỨC MỚI</h1>
    <p class="text-muted text-uppercase small" style="letter-spacing: 3px;">Kiến tạo giá trị vô hạn cho cộng đồng</p>
</div>

<div class="card-luxury p-5 mb-5 shadow-lg">
    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row g-4">
            <div class="col-md-8">
                <div class="mb-4">
                    <label class="form-label text-uppercase small fw-bold mb-2" style="color: #FFFFFF; letter-spacing: 1px;">Tên khóa học vinh dự</label>
                    <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="VD: Nghệ thuật đàm phán tối cao">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="form-label text-uppercase small fw-bold mb-2" style="color: #FFFFFF; letter-spacing: 1px;">Sơ lược nội dung</label>
                    <textarea name="description" rows="6" class="form-control @error('description') is-invalid @enderror" placeholder="Mô tả sự đẳng cấp của khóa học này...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-dark border-secondary p-4 mb-4" style="border-style: dashed !important; border-width: 2px !important;">
                    <label class="form-label text-uppercase small fw-bold mb-3 d-block text-center" style="color: #FFFFFF;">Biểu tượng khóa học</label>
                    <div class="text-center mb-3">
                        <i class="bi bi-cloud-upload display-4 text-muted"></i>
                    </div>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase small fw-bold mb-2" style="color: #FFFFFF;">Giá trị đầu tư (VNĐ)</label>
                    <input type="number" name="price" class="form-control form-control-lg @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="0.00">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase small fw-bold mb-2" style="color: #FFFFFF;">Trạng thái hiển thị</label>
                    <select name="status" class="form-select form-select-lg @error('status') is-invalid @enderror">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Bản nháp riêng tư</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Công bố toàn cầu</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 mt-5">
                <div class="d-flex justify-content-end gap-3">
                    <button type="reset" class="btn btn-outline-secondary px-5">Xóa dữ liệu</button>
                    <button type="submit" class="btn btn-gold px-5 py-3 fs-5">Lưu trữ khóa học</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
