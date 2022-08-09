<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|min:6|max:50|unique:products',
            'brand' => 'required|min:4|max:12|',
            'code' => 'required|min:6|max:12|unique:products',
            'description' => 'required|min:10|max:300',
            'price' => 'required|min:100000|max:100000000|numeric',
            'discount' => 'required|min:100|max:1000|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.min' => 'Tên sản phẩm không ít hơn 6 ký tự',
            'name.max' => 'Tên sản phẩm không nhiều hơn 50 ký tự',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'brand.required' => 'Tên nhãn hiệu không được bỏ trống',
            'brand.min' => 'Tên nhãn hiệu không ít hơn 4 ký tự',
            'brand.max' => 'Tên nhãn hiệu không nhiều hơn 12 ký tự',
            'code.required' => 'Mã sản phẩm không được để trống',
            'code.min' => 'Mã sản phẩm không ít hơn 6 ký tự',
            'code.max' => 'Mã sản phẩm không nhiều hơn 12 ký tự',
            'code.unique' => 'Mã sản phẩm đã tồn tại',
            'description.required' => 'Mô tả sản phẩm không được để trống',
            'description.min' => 'Mô tả sản phẩm không ít hơn 10 ký tự',
            'description.max' => 'Mô tả sản phẩm không nhiều hơn 250 ký tự',
            'price.required' => 'Giá sản phẩm không được để trống',
            'price.min' => 'Giá sản phẩm không ít hơn 6 ký tự',
            'price.max' => 'Giá sản phẩm không nhiều hơn 10 ký tự',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'discount.required' => 'Số lượng sản phẩm không được để trống',
            'discount.min' => 'Số lượng sản phẩm không ít hơn 100',
            'discount.max' => 'Số lượng sản phẩm không nhiều hơn 1000 ký tự',
            'discount.numeric' => 'Số lượng sản phẩm phải là số',
        ];
    }
}
