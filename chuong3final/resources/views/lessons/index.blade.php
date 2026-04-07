@extends('layouts.master')

@section('content')
    <a href="{{ route('courses.index') }}" style="display: inline-block; margin-bottom: 15px; text-decoration: none; color: #007bff; font-weight: bold;">
        &larr; Quay lại danh sách khóa học
    </a>
    
    <h2 style="margin-top: 0;">Quản lý bài học</h2>

    <div style="background: #f4f4f4; padding: 20px; margin-bottom: 25px; border-radius: 8px; border: 1px solid #ddd;">
        <h4 style="margin-top: 0; color: #333;">Thêm Bài Học Mới</h4>
        <form action="{{ route('lessons.store', ['course_id' => request()->route('course_id')]) }}" method="POST">
            @csrf
            <div style="margin-bottom: 10px;">
                <input type="text" name="title" placeholder="Tiêu đề bài học (*)" required style="padding: 8px; width: 300px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 10px;">
                <input type="text" name="video_url" placeholder="Video URL (Link Youtube...)" style="padding: 8px; width: 300px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 15px;">
                <input type="number" name="order" placeholder="Thứ tự (*)" required style="padding: 8px; width: 100px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <button type="submit" style="padding: 8px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
                + Thêm bài học
            </button>
        </form>
    </div>

    <h4 style="margin-top: 0; color: #333;">Danh sách bài học hiện tại</h4>
    <table border="1" cellpadding="12" style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead style="background-color: #e9ecef;">
            <tr>
                <th style="width: 80px; text-align: center;">Thứ tự</th>
                <th>Tiêu đề</th>
                <th>Video URL</th>
                <th style="width: 150px; text-align: center;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lessons as $lesson)
                <tr>
                    <td style="text-align: center; font-weight: bold;">{{ $lesson->order }}</td>
                    <td>{{ $lesson->title }}</td>
                    <td>
                        @if($lesson->video_url)
                            <a href="{{ $lesson->video_url }}" target="_blank" style="color: #17a2b8;">Xem Video</a>
                        @else
                            <span style="color: #999; font-style: italic;">Không có</span>
                        @endif
                    </td>
                    <td style="text-align: center; position: relative;">
                        <button onclick="document.getElementById('edit-form-{{ $lesson->id }}').style.display='block'" style="background: #ffc107; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;">Sửa</button>

                        <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: white; background: #dc3545; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>

                        <div id="edit-form-{{ $lesson->id }}" style="display: none; background: #fff; padding: 15px; border: 1px solid #ccc; border-radius: 5px; position: absolute; right: 0; z-index: 100; margin-top: 5px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 250px; text-align: left;">
                            <form action="{{ route('lessons.update', $lesson->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <label style="font-size: 12px; font-weight: bold;">Tiêu đề:</label>
                                <input type="text" name="title" value="{{ $lesson->title }}" required style="width: 100%; margin-bottom: 8px; padding: 5px; box-sizing: border-box;">
                                
                                <label style="font-size: 12px; font-weight: bold;">Video URL:</label>
                                <input type="text" name="video_url" value="{{ $lesson->video_url }}" style="width: 100%; margin-bottom: 8px; padding: 5px; box-sizing: border-box;">
                                
                                <label style="font-size: 12px; font-weight: bold;">Thứ tự:</label>
                                <input type="number" name="order" value="{{ $lesson->order }}" required style="width: 100%; margin-bottom: 10px; padding: 5px; box-sizing: border-box;">
                                
                                <button type="submit" style="background: #28a745; color: #fff; border: none; padding: 5px 10px; border-radius: 3px;">Lưu</button>
                                <button type="button" onclick="document.getElementById('edit-form-{{ $lesson->id }}').style.display='none'" style="background: #ccc; border: none; padding: 5px 10px; border-radius: 3px; margin-left: 5px;">Hủy</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" style="text-align: center; color: #666; padding: 20px;">Chưa có bài học nào.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection