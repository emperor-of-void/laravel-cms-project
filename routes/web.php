<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LessonController;

Route::get('/', [CourseController::class, 'dashboard'])->name('dashboard');

// 1. Thêm dòng này để tạo trang Thùng rác (Phải đặt trên route resource)
Route::get('courses/trash', [CourseController::class, 'trash'])->name('courses.trash');

// 2. Route khôi phục
Route::post('courses/{id}/restore', [CourseController::class, 'restore'])->name('courses.restore');

Route::resource('courses', CourseController::class);
Route::resource('enrollments', EnrollmentController::class)->only(['index', 'create', 'store']);
Route::resource('lessons', LessonController::class);