<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightRequest extends FormRequest
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
            'number'                => 'required|numeric|unique:flights,number,'. $this->request->get('number'),
            'airline_id'            => 'required|int|exists:airlines,id',
            'departure_airport_id'  => 'required|int|exists:airports,id',
            'departure_time'        => 'date_format:"H:i"|required',
            'arrival_airport_id'    => 'required|int|exists:airports,id',
            'arrival_time'          => 'date_format:"H:i"|required',
            'price'                 => 'required|numeric|min:0',
        ];
    }

    public function attributes(): array {
        return [
            'airline_id'           => 'airline',
            'departure_airport_id' => 'departure aperotport',
            'departure_time'       => 'departure time',
            'arrival_airport_id'   => 'arrival aperotport',
            'arrival_time'         => 'departure time',
        ];
    }
}
