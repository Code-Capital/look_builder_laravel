<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddLookBuilderRequest extends FormRequest
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
            'title' => 'required|string',
            'product_image' => 'required|image',
            'layer_image' => 'required|image',
            'color' => 'required|string',
            'size' => 'required|string',
            'price' => 'required|numeric',
        ];
    }
}
