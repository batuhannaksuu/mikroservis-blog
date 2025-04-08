<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateRequest extends FormRequest
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
            'title' => 'sometimes|string|max:255',
            'body'  => 'sometimes|string',
        ];
    }

    public function messages()
    {
        return [
            'title.string' => 'Başlık metin olmalıdır.',
            'title.max'    => 'Başlık en fazla 255 karakter olabilir.',
            'body.string'  => 'İçerik metin olmalıdır.',
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
