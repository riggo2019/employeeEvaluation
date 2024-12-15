<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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

     //Validate dữ liệu ở form đăng nhập
    public function rules(): array
    {
        return [
            'user_name' => 'required|exists:users',
            'password' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'user_name.required' => 'Vui lòng nhập tên đăng nhập !',
            'user_name.exists' => 'Tên đăng nhập không tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu !',
        ];
    }
}
