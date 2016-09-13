<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\JsonResponse;

class TransactionRequest extends FormRequest
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
            'documentType' => 'required',
            'document' => 'required|alpha_num|max:12',
            'firstName' => 'max:60',
            'lastName' => 'max:60',
            'company' => 'max:60',
            'emailAddress' => 'required|email|max:80',
            'address' => 'max:100',
            'country' => 'required|max:2',
            'province' => 'max:50',
            'city' => 'max:50',
            'phone' => 'string|max:30',
            'mobile' => 'string|max:30',
            'reference' => 'required|max:32',
            'amount' => 'required|numeric',
        ];
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(array $errors)
    {
        // Se sobreescribe el metodo response para poder enviar code 200 en vez de 422 en el ajax
        return new JsonResponse(['error' => $errors], 200);
    }
}
