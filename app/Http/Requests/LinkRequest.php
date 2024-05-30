<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
            'internal_id' => 'required|unique|min:1|max:7',
            'url' => 'required|min:1|max:255|text|unique',
            'created_at' => 'required',
            'publish_at' => 'required',
            'delete_at' => 'required',
        ];
    }
}
