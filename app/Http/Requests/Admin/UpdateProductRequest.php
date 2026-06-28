<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:100',
            'file' => 'nullable|file|mimes:pdf,mp3,mp4,zip|max:51200',
        ];
    }

    public function messages(): array
    {
        return [
            'price.min' => 'Le prix minimum est de 100 FCFA.',
            'file.mimes' => 'Le fichier doit être de type : pdf, mp3, mp4 ou zip.',
            'file.max' => 'Le fichier ne doit pas dépasser 50 Mo.',
        ];
    }
}
