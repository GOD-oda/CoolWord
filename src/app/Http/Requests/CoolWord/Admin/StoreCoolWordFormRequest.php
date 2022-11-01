<?php

declare(strict_types=1);

namespace App\Http\Requests\CoolWord\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoolWordFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string'
            ],
            'description' => [
                'string'
            ],
            'tag_ids' => [
                'array'
            ],
            'tag_ids.*' => [
                'int'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nameは必須です'
        ];
    }
}
