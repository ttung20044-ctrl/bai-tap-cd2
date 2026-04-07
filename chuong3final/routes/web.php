<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;

// 1. Dashboard
Route::get('/', [CourseController::class, 'dashboard'])->name('dashboard');

// 2. Quản lý Khóa học
Route::resource('courses', CourseController::class);
Route::patch('courses/{id}/restore', [CourseController::class, 'restore'])->name('courses.restore');

// 3. Quản lý Bài học
Route::get('courses/{course_id}/lessons', [LessonController::class, 'index'])->name('lessons.index');
Route::post('courses/{course_id}/lessons', [LessonController::class, 'store'])->name('lessons.store');
Route::put('lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
Route::delete('lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');

// 4. Quản lý Đăng ký
Route::get('enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
Route::post('enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');