<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AirportRequest extends FormRequest
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
            'code'       => 'required|unique:airports,code,'. $this->request->get('code'),
            'name'       => 'required|string|max:255',
            'city_id'    => 'required|int|exists:cities,id',
            'longitude'  => 'required|numeric',
            'latitude'   => 'required|numeric',
            'timezone'   => 'required|timezone'
        ];
    }

    public function attributes(): array {
        return [
            'city_id' => 'city',
        ];
    }

}
