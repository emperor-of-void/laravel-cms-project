<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép gửi form
    }

    public function rules(): array
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'title'     => 'required|string|max:255',
            'content'   => 'required',
            'video_url' => 'nullable|url', // Phải là định dạng đường dẫn URL
            'order'     => 'required|integer|min:0'
        ];
    }
}