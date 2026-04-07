@extends('layouts.master')

@section('content')
<div class="dashboard">
    <h2 style="margin-top: 0;">Dashboard Thống Kê</h2>
    
    <div style="display: flex; gap: 20px; margin-bottom: 30px;">
        <div style="flex: 1; padding: 20px; background: #007bff; color: white; border-radius: 8px;">
            <h3 style="margin: 0;">Tổng Khóa Học</h3>
            <p style="font-size: 24px; font-weight: bold; margin: 10px 0 0;">{{ $totalCourses }}</p>
        </div>
        <div style="flex: 1; padding: 20px; background: #28a745; color: white; border-radius: 8px;">
            <h3 style="margin: 0;">Tổng Học Viên</h3>
            <p style="font-size: 24px; font-weight: bold; margin: 10px 0 0;">{{ $totalStudents }}</p>
        </div>
        <div style="flex: 1; padding: 20px; background: #ffc107; color: #333; border-radius: 8px;">
            <h3 style="margin: 0;">Tổng Doanh Thu</h3>
            <p style="font-size: 24px; font-weight: bold; margin: 10px 0 0;">{{ number_format($totalRevenue) }} VNĐ</p>
        </div>
    </div>

    @if($topCourse)
        <div style="background: #e9ecef; padding: 15px; border-radius: 8px; border-left: 5px solid #17a2b8; margin-bottom: 30px;">
            <h3 style="margin-top: 0; color: #333;">Khóa học phổ biến nhất</h3>
            <p style="margin-bottom: 0; font-size: 16px;">
                <strong>{{ $topCourse->name }}</strong> - Thu hút <span style="color: red; font-weight: bold;">{{ $topCourse->enrollments_count }}</span> học viên.
            </p>
        </div>
    @endif

    <div>
        <h3 style="border-bottom: 2px solid #ccc; padding-bottom: 10px;">Thống kê Doanh thu & Danh sách Card Khóa học</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 15px; margin-top: 15px;">
            @foreach($latestCourses as $course)
                <x-card :course="$course" />
            @endforeach
        </div>
    </div>
</div>
@endsection