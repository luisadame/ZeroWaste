<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Traits\Imageable;

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
            'type_ids' => 'required|array|min:1',
            'type_ids.*' => 'integer|exists:food_types,id',
            'cooking_time' => 'required|integer|max:525600',
            'country_code' => 'required|string|size:2|exists:countries,code',
            'content' => 'required|string|max:10000',
            'images' => 'array|max:10|min:1',
            'images.*' => 'string'
        ];
    }
}
