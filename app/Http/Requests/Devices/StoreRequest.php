<?php

namespace App\Http\Requests\Devices;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'type' => 'required',
            'red' => 'required_if:type,2',
            'green' => 'required_if:type,2',
            'blue' => 'required_if:type,2',
            'brightness' => 'required_if:type,3',
        ];
    }
}
