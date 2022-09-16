<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSlideRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'url' => 'required|max:50',
            'sort_by' => 'required|numeric|gte:1',
            'thumb' => 'image',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên ảnh quảng cáo',
            'url.required' => 'Vui lòng nhập tên miền website liên kết',
            'thumb.image' => 'Ảnh quảng cáo phải là hình ảnh',
            'sort_by.required' => 'Vui lòng nhập thứ tự',
            'sort_by.gte' => 'Số thứ tự phải lớn hơn hoặc bằng 1',
        ];
    }
}
