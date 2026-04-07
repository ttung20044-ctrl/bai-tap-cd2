<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Xác định xem người dùng có quyền thực hiện request này hay không.
     * Trả về true để ai cũng có quyền thêm/sửa khóa học.
     */
    public function authorize()
    {
        return true; 
    }

    /**
     * Chứa các quy tắc kiểm duyệt (validation rules) áp dụng cho request.
     * (Đáp ứng Mục 2.1: Validate required, giá > 0, Upload ảnh)
     */
    public function rules()
    {
        return [
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|gt:0', // gt:0 nghĩa là giá phải > 0
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Bắt buộc là ảnh, tối đa 2MB
            'status'      => 'required|in:draft,published',
        ];
    }

    /**
     * Tùy chỉnh lại các câu thông báo lỗi sang tiếng Việt (Tùy chọn để app xịn hơn)
     */
    public function messages()
    {
        return [
            'name.required'   => 'Tên khóa học không được để trống.',
            'price.required'  => 'Vui lòng nhập giá khóa học.',
            'price.gt'        => 'Giá khóa học phải lớn hơn 0.',
            'image.image'     => 'File tải lên phải là định dạng hình ảnh.',
            'image.max'       => 'Kích thước ảnh không được vượt quá 2MB.',
            'status.required' => 'Vui lòng chọn trạng thái.',
        ];
    }
}