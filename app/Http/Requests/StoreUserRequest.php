<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|unique:users|max:191',
            'name' => 'required|string',
            'user_catelogue_id' => 'gt:0',
            'password' => 'required|string|min:6',
            "re_password"=>'required|string|same:password'
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'Bạn chưa nhập email',
            'email.email' =>'Email chưa đúng định dạng. Ví dụ: abc@gmail.com',
            "email.unique" =>"Email đã tồn tại",
            "email.string" => "Email phải là dạng ký tự",
            "email.max" => "Độ dài email tối đa 191 ký tự",
            "name.required" => "Bạn chưa nhập họ tên",
            "name   .string" => "Họ tên phải là định dạng ký tự",
            'user_catelogue_id.gt' => 'Bạn chưa nhập vào nhóm thành viên',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            're_password.required' => 'Bạn phải nhập vào ô nhập lại mật khẩu',
            're_password.same' => 'Mật khẩu không khớp',
        ];
    }
}
