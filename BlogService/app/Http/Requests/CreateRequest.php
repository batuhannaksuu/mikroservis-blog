<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateRequest extends FormRequest
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
            'user_id' => 'required|integer',
            'title'   => 'required|string|max:255',
            'body'    => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Kullanıcı alanı gereklidir.',
            'user_id.integer'  => 'Kullanıcı alanı bir sayı olmalıdır.',
            'title.required'   => 'Başlık alanı gereklidir.',
            'title.string'     => 'Başlık metin olmalıdır.',
            'title.max'        => 'Başlık en fazla 255 karakter olabilir.',
            'body.required'    => 'İçerik alanı gereklidir.',
            'body.string'      => 'İçerik metin olmalıdır.',
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
