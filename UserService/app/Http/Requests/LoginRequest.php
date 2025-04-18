<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
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
    public function rules()
    {
        return [
            'email'    => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'E-posta alanı gereklidir.',
            'email.email'       => 'Geçerli bir e-posta adresi giriniz.',
            'password.required' => 'Şifre alanı gereklidir.',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();

        throw new ValidationException(
            $validator,
            response()->json([
                'success' => false,
                'message' => $errors[0],
                'data' => null,
            ], 422)
        );
    }
}
