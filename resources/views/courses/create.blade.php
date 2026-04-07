@extends('layouts.master')

@section('content')
    <h2 class="mb-4">Thêm Khóa học Mới</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Tên khóa học</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá (VNĐ)</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Bản nháp)</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Xuất bản)</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Ảnh đại diện (Tùy chọn)</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary px-4">Lưu Khóa Học</button>
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
@endsection