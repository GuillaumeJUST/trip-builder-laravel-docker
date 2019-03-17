<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'code'      => 'required|unique:cities,code,'. $this->request->get('code'),
            'name'      => 'required|string|max:255',
            'region_id' => 'required|int|exists:regions,id',
        ];
    }

    public function attributes(): array {
        return [
            'region_id' => 'region',
        ];
    }
}
