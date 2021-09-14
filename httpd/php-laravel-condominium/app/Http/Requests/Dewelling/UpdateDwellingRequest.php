<?php

namespace App\Http\Requests\Dewelling;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDwellingRequest extends FormRequest
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
       	    "name" => "required|max:10",
	    "location" => "required",
	    "aliquot" => "required|gte:1",
	    "dwelling_type_id" => "required",
	    "user_id" =>  "required" 
        ];
    }
}
