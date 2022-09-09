<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required',
            'parent_id' => 'numeric',
            'description' => 'required',
            'content' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'description.required' => 'Bạn chưa nhập mô tả',
            'content.required' => 'Bạn chưa nhập mô tả chi tiết',
            'parent_id.numeric' => 'Kiểu dữ liệu của parent_id phải là kiểu ký tự số',
        ];
    }
}
