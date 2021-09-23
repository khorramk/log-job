<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
class JobRequest extends FormRequest
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
            'summary' => 'required|string|max:150',
            'description' => 'required|string|max:500',
            'property_name' => 'required|string|max:255',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'summary.required' => 'Summary is required',
            'description.required' => 'Description is required',
            'property_name.required' => 'Property name is required',
            'first_name.required' => 'First Name is required',
            'last_name.required' => 'Last Name is required',
        ];
    }

     /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json(['errors' => $errors], JsonResponse::HTTP_EXPECTATION_FAILED)
        );
    }
}
