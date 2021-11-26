<?php

namespace App\Http\Requests\MonthlyMovement;

use Illuminate\Foundation\Http\FormRequest;

class StoreMonthlyMovementRequest extends FormRequest
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
            "year" => "required|digits:4|between:".(date('Y')-1).",".(date('Y')),
	        "month" => "required|between:1,12",
        ];
    }
}
