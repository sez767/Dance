<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validator extends FormRequest
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
            'title'=>['required', 'string', 'min:3'],
            'city'=>['required', 'string', 'min:3'],
            'date'=>['date_format:"Y-m-d"'],
            'address'=>['required', 'string', 'min:3'],
            'contacts'=>['required','numeric', 'digits_between:6,10'],
            'organizers'=>['required', 'string', 'min:3'],
            'contribution'=>['required', 'string', 'min:3'],
            'conditions'=>['required', 'string', 'min:3'],
            'price'=>['required', 'string', 'min:3'],
            'program'=>['required', 'string', 'min:3'],
            'dance_style'=>['required', 'string', 'min:3'],
            'living_place'=>['required', 'string', 'min:3'],
            'age'=>['required', 'string', 'min:3'],
            'experience'=>['required', 'string', 'min:3'],
            'participation'=>['required', 'string', 'min:3'],
            'about_yourself'=>['required', 'string', 'min:3'],
            'number'=>['required','numeric', 'digits_between:6,10'],
            'description'=>['required', 'string', 'min:3'],
            'type'=>['required', 'string', 'min:3'],
            'area'=>['required', 'string', 'min:3'],
            'coating'=>['required', 'string', 'min:3'],
            'type'=>['required', 'string', 'min:3'],
            'path'=>['required', 'string', 'min:3'],
            'kind'=>['required', 'string', 'min:3'],
            'duration'=>['required', 'string', 'min:3'],
            'recording'=>['required', 'string', 'min:3'],
            'content'=>['required', 'string', 'min:3'],
            'author'=>['required', 'string', 'min:3'],
            'name'=>['required', 'string', 'min:3'],
            'label'=>['required', 'string', 'min:3'],
            'permissions'=>['required', 'string', 'min:3'],
            'new_user'=>['required', 'string', 'min:3'],
            'email_user'=>['required', 'email', 'string'],
            'contact'=>['required','numeric', 'digits_between:6,10'],
        ];
    }
}
