<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
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
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Ad alanı gereklidir.',
            'name.string'       => 'Ad alanı metin olmalıdır.',
            'name.max'          => 'Ad alanı en fazla 255 karakter olabilir.',
            'email.required'    => 'E-posta alanı gereklidir.',
            'email.email'       => 'Geçerli bir e-posta adresi giriniz.',
            'email.max'         => 'E-posta alanı en fazla 255 karakter olabilir.',
            'email.unique'      => 'Bu e-posta adresi zaten kullanımda.',
            'password.required' => 'Şifre alanı gereklidir.',
            'password.string'   => 'Şifre metin olmalıdır.',
            'password.min'      => 'Şifre en az 6 karakter olmalıdır.',
            'password.confirmed'=> 'Şifre tekrarı uyuşmuyor.',
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
