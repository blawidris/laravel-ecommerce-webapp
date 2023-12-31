<?php

namespace App\Http\Requests\Config;

use Illuminate\Foundation\Http\FormRequest;

class LocalRequest extends FormRequest
{

    public $stopOnFirstFailure = true;


    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'country' => ['required'],
            'language' => ['required'],
            'currency' => ['required'],
        ];
    }
}