<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\StudentController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [CourseController::class, 'catalog'])->name('home');
Route::get('/dashboard', [CourseController::class, 'dashboard'])->name('dashboard');
Route::get('catalog', [CourseController::class, 'catalog'])->name('catalog.index');
Route::get('catalog/{course}', [CourseController::class, 'show'])->name('catalog.show');

// Admin routes
Route::get('courses/trash', [CourseController::class, 'trash'])->name('courses.trash');
Route::post('courses/{id}/restore', [CourseController::class, 'restore'])->name('courses.restore');
Route::resource('courses', CourseController::class)->except(['show']);
Route::resource('lessons', LessonController::class)->except(['show']);
Route::get('enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
Route::resource('enrollments', EnrollmentController::class)->only(['create', 'store']);

// Student portal
Route::get('student/courses', [StudentController::class, 'index'])->name('student.courses');
Route::get('student/courses/{course}', [StudentController::class, 'show'])->name('student.courses.show');