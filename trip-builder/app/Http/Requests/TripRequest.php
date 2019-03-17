<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
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
            'departure_airport_id' => 'required|int|exists:airports,id',
            'arrival_airport_id' => 'required|int|exists:airports,id',
            'departure_datetime' => 'required|date_format:"Y-m-d H:i"',
            'is_round_trip' => 'required|boolean',
            'preferred_airline_id' => 'nullable|int|exists:airlines,id',
        ];
    }

    public function attributes(): array {
        return [
            'departure_airport_id' => 'departure airport',
            'arrival_airport_id' => 'arrival airport',
            'departure_datetime' => 'departure date',
            'preferred_airline_id' => 'preferred airline',
            'is_round_trip' => 'route trip',
        ];
    }
}
