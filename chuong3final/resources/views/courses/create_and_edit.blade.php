@extends('layouts.master')

@section('content')
<div class="form-container">
    <h2>{{ isset($course) ? 'Sửa khóa học' : 'Thêm khóa học mới' }}</h2>

    <form action="{{ isset($course) ? route('courses.update', $course->id) : route('courses.store') }}" 
          method="POST" 
          enctype="multipart/form-data">
        
        @csrf
        @if(isset($course))
            @method('PUT') @endif

        <div class="form-group">
            <label>Tên khóa học:</label>
            <input type="text" name="name" value="{{ old('name', $course->name ?? '') }}" class="form-control" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Giá (VNĐ):</label>
            <input type="number" name="price" value="{{ old('price', $course->price ?? '') }}" class="form-control" required>
            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Ảnh đại diện:</label>
            <input type="file" name="image" class="form-control">
            @if(isset($course) && $course->image)
                <img src="{{ asset('storage/' . $course->image) }}" width="100" class="mt-2">
            @endif
        </div>

        <div class="form-group">
            <label>Trạng thái:</label>
            <select name="status" class="form-control">
                <option value="draft" {{ old('status', $course->status ?? '') == 'draft' ? 'selected' : '' }}>Nháp (Draft)</option>
                <option value="published" {{ old('status', $course->status ?? '') == 'published' ? 'selected' : '' }}>Xuất bản (Published)</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
    </form>
</div>
@endsection