<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'menu_id' => 'required|numeric',
            'price' => 'required|numeric|min:1',
            'price_sale' => 'numeric|min:0',
            'description' => 'required',
            'content' => 'required',
            // 'thumb' => 'image|nullable'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên sản phẩm',
            'menu_id.required' => 'Bạn chưa chọn danh mục',
            'price.required' => 'Bạn chưa nhập giá sản phẩm',
            // 'price_sale.required' => 'Bạn chưa nhập giá giảm sản phẩm',
            'description.required' => 'Bạn chưa nhập mô tả',
            'content.required' => 'Bạn chưa nhập mô tả chi tiết',
            'menu_id.numeric' => 'Danh mục bạn chọn chưa đúng',
            'price.numeric' => 'Giá tiền phải là kiểu số nguyên',
            'price_sale.numeric' => 'Giá giảm phải là kiểu số nguyên',
            'price.min' => 'Giá tiền phải lớn hơn 0',
            'price_sale.min' => 'Giá giảm phải lớn hơn 0',
            // 'thumb.image' => 'Tập tin upload phải là hình ảnh',
        ];
    }
}
