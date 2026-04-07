<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        // Sử dụng Eager Loading để lấy khóa học kèm danh sách học viên 
        // và đếm tổng số học viên (tránh N+1 query)
        $courses = Course::with('students')
                         ->withCount('enrollments')
                         ->get();

        return view('enrollments.index', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ]);

        $student = Student::firstOrCreate(
            ['email' => $request->email],
            ['name' => $request->name]
        );

        // syncWithoutDetaching giúp không bị lỗi nếu học viên lỡ bấm đăng ký 2 lần
        $student->courses()->syncWithoutDetaching([$request->course_id]);

        return back()->with('success', 'Đăng ký khóa học thành công!');
    }
}