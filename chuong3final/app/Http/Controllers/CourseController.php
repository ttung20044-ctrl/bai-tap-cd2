<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function dashboard()
    {
        $totalCourses = Course::count();
        $totalStudents = Student::count();
        
        $totalRevenue = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->sum('courses.price');

        // Đã sửa: Thêm withCount để tính được doanh thu từng khóa trong Component
        $latestCourses = Course::withCount('enrollments')->latest()->take(5)->get();

        $topCourse = Course::withCount('enrollments')
                           ->orderBy('enrollments_count', 'desc')
                           ->first();

        return view('dashboard', compact('totalCourses', 'totalStudents', 'totalRevenue', 'latestCourses', 'topCourse'));
    }

    public function index(Request $request)
    {
        // Đã sửa: Thêm withCount('enrollments')
        $query = Course::withTrashed()->with(['lessons', 'enrollments'])->withCount('enrollments');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('status', $search);
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        // Đã sửa: Xử lý sắp xếp theo số học viên
        $sortField = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('order', 'desc');

        if ($sortField == 'enrollments_count') {
            $query->orderBy('enrollments_count', $sortOrder);
        } else {
            $query->orderBy($sortField, $sortOrder);
        }

        $courses = $query->paginate(10);
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create_and_edit');
    }

    public function store(CourseRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']) . '-' . time();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($data);
        return redirect()->route('courses.index')->with('success', 'Thêm khóa học thành công!');
    }

    public function edit(Course $course)
    {
        return view('courses.create_and_edit', compact('course'));
    }

    public function update(CourseRequest $request, Course $course)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']) . '-' . time();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($data);
        return redirect()->route('courses.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Đã xóa khóa học vào thùng rác!');
    }

    public function restore($id)
    {
        $course = Course::withTrashed()->findOrFail($id);
        $course->restore();
        return redirect()->route('courses.index')->with('success', 'Đã khôi phục khóa học thành công!');
    }
}