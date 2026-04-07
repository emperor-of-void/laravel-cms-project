@extends('layouts.master')

@section('content')
    <h2 class="mb-4">Đăng ký Khóa học</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm col-md-8">
        <div class="card-body">
            <form action="{{ route('enrollments.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Chọn khóa học</label>
                    <select name="course_id" class="form-control" required>
                        <option value="">-- Chọn một khóa học --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }} ({{ number_format($course->price) }}đ)</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên học viên</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Email học viên</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary px-4">Xác nhận Đăng ký</button>
            </form>
        </div>
    </div>
@endsection