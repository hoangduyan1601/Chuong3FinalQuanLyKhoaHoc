@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Chỉnh sửa khóa học: {{ $course->name }}</h1>
    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Quay lại
    </a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-3">
                <div class="col-md-8">
                    <label for="name" class="form-label">Tên khóa học <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $course->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="price" class="form-label">Giá (VNĐ) <span class="text-danger">*</span></label>
                    <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $course->price) }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="description" class="form-label">Mô tả khóa học</label>
                    <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description', $course->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="image" class="form-label">Hình ảnh đại diện</label>
                    @if($course->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $course->image) }}" width="150" class="rounded border">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="draft" {{ old('status', $course->status) == 'draft' ? 'selected' : '' }}>Nháp</option>
                        <option value="published" {{ old('status', $course->status) == 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mt-4 text-end">
                    <button type="submit" class="btn btn-success">Cập nhật khóa học</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
