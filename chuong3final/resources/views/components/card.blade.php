@props(['course'])

<div style="border: 1px solid #ddd; padding: 15px; border-radius: 8px; background: #fff; margin-bottom: 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <h4 style="margin: 0 0 10px 0; color: #007bff;">{{ $course->name }}</h4>
    <p style="margin: 5px 0;"><strong>Giá:</strong> {{ number_format($course->price) }} VNĐ</p>
    <p style="margin: 5px 0;"><strong>Học viên đăng ký:</strong> {{ $course->enrollments_count ?? 0 }} người</p>
    <p style="margin: 5px 0; color: #28a745;">
        <strong>Doanh thu:</strong> {{ number_format($course->price * ($course->enrollments_count ?? 0)) }} VNĐ
    </p>
    <div style="margin-top: 10px;">
        <x-badge :status="$course->status" />
    </div>
</div>