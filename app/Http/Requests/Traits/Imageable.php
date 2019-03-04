<?php
namespace App\Http\Requests\Traits;

use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule;

trait Imageable
{
    public function withValidator(Validator $validator)
    {
        $validator->addRules([
            'images' => 'required|array',
            'images.*' => [
                'file',
                'image',
                'max:6144',
                Rule::dimensions()->minWidth(640)->minHeight(480)
            ]
        ]);
    }
}
