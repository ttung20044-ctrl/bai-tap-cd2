@extends('layouts.master')

@section('content')
    <h2 style="margin-top: 0;">Quản lý Ghi danh Học viên</h2>

    <div style="background: #e9ecef; padding: 20px; border-radius: 8px; margin-bottom: 30px; border: 1px solid #ddd;">
        <h4 style="margin-top: 0; color: #17a2b8;">Đăng ký khóa học cho học viên mới</h4>
        <form action="{{ route('enrollments.store') }}" method="POST" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end;">
            @csrf
            <div>
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Chọn Khóa học:</label>
                <select name="course_id" required style="padding: 8px; width: 250px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">-- Lựa chọn khóa học --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Tên Học viên:</label>
                <input type="text" name="name" placeholder="Ví dụ: Nguyễn Văn A" required style="padding: 8px; width: 200px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div>
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Email:</label>
                <input type="email" name="email" placeholder="Ví dụ: nva@gmail.com" required style="padding: 8px; width: 200px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div>
                <button type="submit" style="padding: 9px 20px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
                    Ghi danh ngay
                </button>
            </div>
        </form>
    </div>

    <h4 style="margin-top: 0; color: #333;">Thống kê danh sách học viên</h4>
    @if($courses->isEmpty())
        <p>Hiện chưa có khóa học nào trên hệ thống.</p>
    @else
        @foreach($courses as $course)
            <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 5px; background: #fff;">
                <h3 style="margin-top: 0; color: #007bff;">{{ $course->name }}</h3>
                <p><strong>Tổng số học viên đăng ký:</strong> <span style="color: red; font-weight: bold;">{{ $course->enrollments_count }}</span></p>
                
                @if($course->students->count() > 0)
                    <table border="1" cellpadding="8" style="width: 100%; border-collapse: collapse; text-align: left;">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th style="width: 50px; text-align: center;">STT</th>
                                <th>Tên học viên</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($course->students as $index => $student)
                                <tr>
                                    <td style="text-align: center;">{{ $index + 1 }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p style="color: #666; font-style: italic;">Chưa có học viên nào đăng ký khóa học này.</p>
                @endif
            </div>
        @endforeach
    @endif
@endsection