<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RequestValidate extends FormRequest
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
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:250',
            'type' => 'required|max:1',
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:5128',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'name.max' => 'Name max length limit is 50',
            'description.required' => 'Description is required!',
            'description.max' => 'Name max length limit is 250',
            'file.required' =>'File required',
            'file.image' => 'File is not image',
            'type.max' => 'Type max length limit is 1',
            'type.required' => 'Type is required'
            
        ];
    }
}