<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Xác định xem người dùng có quyền thực hiện yêu cầu này không.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Các quy tắc xác thực dữ liệu.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Thông báo lỗi bằng tiếng Việt.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên khóa học không được để trống.',
            'name.max' => 'Tên khóa học không được vượt quá 255 ký tự.',
            'price.required' => 'Giá khóa học không được để trống.',
            'price.numeric' => 'Giá khóa học phải là một con số.',
            'price.min' => 'Giá khóa học không được nhỏ hơn 0.',
            'image.image' => 'File tải lên phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image.max' => 'Hình ảnh không được vượt quá 2MB.',
            'status.required' => 'Trạng thái không được để trống.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ];
    }
}
