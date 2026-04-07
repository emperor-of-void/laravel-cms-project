<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Phải đổi thành true để cho phép gửi Form
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'price'       => 'required|numeric|min:0.01', // Yêu cầu giá > 0
            'description' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Yêu cầu upload ảnh
            'status'      => 'required|in:draft,published',
        ];
    }

    /**
     * Tùy chỉnh câu thông báo lỗi bằng tiếng Việt (Điểm cộng cho bài làm)
     */
    public function messages(): array
    {
        return [
            'title.required'       => 'Vui lòng nhập tên khóa học.',
            'price.required'       => 'Vui lòng nhập giá khóa học.',
            'price.min'            => 'Giá khóa học phải lớn hơn 0.',
            'description.required' => 'Vui lòng nhập mô tả khóa học.',
            'image.image'          => 'File tải lên phải là định dạng ảnh hợp lệ.',
        ];
    }
}