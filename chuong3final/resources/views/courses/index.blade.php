@extends('layouts.master')

@section('content')
    <h2>Danh sách khóa học</h2>

    <form action="{{ route('courses.index') }}" method="GET" style="margin-bottom: 20px; background: #f8f9fa; padding: 15px; border-radius: 5px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm tên khóa học..." style="padding: 5px; width: 200px;">
        
        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Giá từ..." style="padding: 5px; width: 120px;">
        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Đến giá..." style="padding: 5px; width: 120px;">
        
        <select name="sort_by" style="padding: 5px;">
            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Mới nhất</option>
            <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Giá</option>
            <option value="enrollments_count" {{ request('sort_by') == 'enrollments_count' ? 'selected' : '' }}>Số học viên</option>
        </select>
        
        <select name="order" style="padding: 5px;">
            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Giảm dần</option>
            <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Tăng dần</option>
        </select>

        <button type="submit" style="padding: 6px 15px; background: #28a745; color: white; border: none; border-radius: 3px; cursor: pointer;">Lọc & Tìm kiếm</button>
        <a href="{{ route('courses.index') }}" style="margin-left: 10px; color: red; text-decoration: none;">Xóa lọc</a>
    </form>

    <a href="{{ route('courses.create') }}" style="display:inline-block; margin-bottom: 15px; padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px;">
        + Thêm khóa học
    </a>

    <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead style="background-color: #e9ecef;">
            <tr>
                <th>Tên khóa học</th>
                <th>Giá</th>
                <th>Học viên</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
                <tr style="{{ $course->trashed() ? 'background-color: #fce4e4;' : '' }}">
                    <td>
                        {{ $course->name }}
                        @if($course->trashed())
                            <span style="color: red; font-size: 0.85em; font-weight: bold;">(Đã xóa)</span>
                        @endif
                    </td>
                    <td>{{ number_format($course->price) }} VNĐ</td>
                    <td>{{ $course->enrollments_count }}</td>
                    <td><x-badge :status="$course->status" /></td>
                    
                    <td>
                        @if($course->trashed())
                            <span style="color: #999; font-style: italic; margin-right: 10px;">(Đã đưa vào thùng rác)</span>
                            <form action="{{ route('courses.restore', $course->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="color: #ff9800; background: none; border: none; padding: 0; cursor: pointer; text-decoration: underline; font-weight: bold;">
                                    Khôi phục
                                </button>
                            </form>
                        @else
                            <a href="{{ route('lessons.index', ['course_id' => $course->id]) }}" style="color: green; text-decoration: none; font-weight: bold;">Quản lý Bài học</a> |
                            <a href="{{ route('courses.edit', $course->id) }}" style="color: blue; text-decoration: none;">Sửa</a> |
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: red; background: none; border: none; padding: 0; cursor: pointer; text-decoration: underline;" onclick="return confirm('Xóa khóa học này?')">Xóa</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align: center; color: #666;">Không có dữ liệu.</td></tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">{{ $courses->links() }}</div>
@endsection