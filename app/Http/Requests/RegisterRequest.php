<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

     //Validate dữ liệu ở form đăng nhập, đăng kí
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => 'required',
            'password' => [
                'required',
                'string',
                'min:6', // Độ dài tối thiểu là 8 ký tự
                'regex:/[a-z]/', // Phải chứa ít nhất một chữ thường    
                'regex:/[A-Z]/', // Phải chứa ít nhất một chữ hoa
                'regex:/[0-9]/', // Phải chứa ít nhất một số
                'confirmed',
            ],
            
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required' => 'Vui lòng nhập họ và tên',
            'last_name.required' => 'Vui lòng nhập tên',
            'user_name.required' => 'Vui lòng nhập tên đăng nhập !',
            'user_name.unique' => 'Tên đăng nhập này đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.regex' => 'Mật khẩu phải chứa cả chữ hoa, chữ thường, và số.',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
        ];
    }
}
