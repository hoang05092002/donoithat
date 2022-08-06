<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:6|max:32',
            'email' => 'required|min:6|max:32|email',
            'password' => 'required|min:6|max:20',
            'confirm_password' => 'required|min:6|max:20|same:password',
            'avatar' => 'required',
            'phone' => 'required|min:10|numeric',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.min' => 'Tên không ít hơn 6 ký tự',
            'name.max' => 'Tên không nhiều hơn 32 ký tự',
            'email.required' => 'Email không được bỏ trống',
            'email.min' => 'Email không ít hơn 6 ký tự',
            'email.max' => 'Email không nhiều hơn 32 ký tự',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password không ít hơn 6 ký tự',
            'password.max' => 'Password không nhiều hơn 20 ký tự',
            'confirm_password.same' => 'Pass ko trùng',
            'confirm_password.required' => 'Pass confirm ko để trônggs',
            'avatar.required' => 'Avatar không được để trống',
            'phone.required' => 'Phone không được để trống',
            'phone.min' => 'Phone không ít hơn 10 ký tự',
            // 'phone.max' => 'Phone không nhiều hơn 12 ký tự',
            'phone.numeric' => 'Phone phải là số',
            'address.required' => 'address không được để trống',
        ];
    }
}
