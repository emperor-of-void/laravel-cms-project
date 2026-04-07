@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fa-solid fa-users me-2"></i>Học viên Đăng ký</h2>
        <a href="{{ route('enrollments.create') }}" class="btn btn-primary shadow-sm">+ Tạo Đăng ký mới</a>
    </div>

    @include('components.alert')

    @foreach($courses as $course)
        <div class="card mb-4 border-0">
            <div class="card-header header-soft py-3 d-flex justify-content-between align-items-center border-0">
                <h5 class="mb-0 fw-bold"><i class="fa-solid fa-graduation-cap text-danger me-2"></i>{{ $course->title }}</h5>
                <span class="badge badge-pink rounded-pill px-3 py-2 shadow-sm">Tổng: {{ $course->students_count }} học viên</span>
            </div>
            <div class="card-body p-0">
                @if($course->students->count() > 0)
                    <table class="table mb-0 table-hover">
                        <thead class="table-light text-muted">
                            <tr>
                                <th class="py-3 px-4">Tên học viên</th>
                                <th class="py-3">Email</th>
                                <th class="py-3">Ngày đăng ký</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($course->students as $student)
                                <tr>
                                    <td class="fw-bold align-middle px-4 text-secondary"><i class="fa-regular fa-user me-2 text-muted"></i>{{ $student->name }}</td>
                                    <td class="align-middle text-primary">{{ $student->email }}</td>
                                    <td class="align-middle text-muted">
                                        <i class="fa-regular fa-clock me-1"></i>
                                        {{ $student->pivot->created_at ? $student->pivot->created_at->format('d/m/Y H:i') : 'Không xác định' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-5 text-muted text-center bg-light">
                        <i class="fa-solid fa-user-xmark mb-3 fa-3x opacity-50"></i><br>
                        Chưa có học viên nào đăng ký khóa này.
                    </div>
                @endif
            </div>
        </div>
    @endforeach
@endsection