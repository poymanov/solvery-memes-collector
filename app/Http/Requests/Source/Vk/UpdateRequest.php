<?php

namespace App\Http\Requests\Source\Vk;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'url'   => [
                'required', 'string', 'url', 'regex:/^https:\/\/vk.com\/.+$/i',
                Rule::unique('vk_parsing_sources')->ignore($this->vk->id, 'id')
            ],
        ];
    }
}
