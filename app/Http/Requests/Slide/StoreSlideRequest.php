<?php

namespace App\Http\Requests\Slide;

use Illuminate\Foundation\Http\FormRequest;

class StoreSlideRequest extends FormRequest
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
            'thumb' => 'required|image',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên ảnh quảng cáo',
            'url.required' => 'Vui lòng nhập tên miền website liên kết',
            'thumb.required' => 'Bạn chưa chọn ảnh quảng cáo',
            'thumb.image' => 'Ảnh quảng cáo phải là hình ảnh',
        ];
    }
}
