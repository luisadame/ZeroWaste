<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreRecipe extends FormRequest
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
            'name' => 'required|string|max:200',
            'type_id' => 'required|integer|exists:food_types,id',
            'cooking_time' => 'required|integer|max:525600',
            'country_code' => 'required|string|size:2|exists:countries,code',
            'content' => 'required|string|max:10000'
        ];
    }
}
