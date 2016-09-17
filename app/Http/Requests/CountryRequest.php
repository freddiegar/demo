<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\JsonResponse;

class CountryRequest extends FormRequest
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
       switch($this->method())
       {
            case 'POST':
                $rules = [
                    'id' => 'required|unique:countries,id|alpha|max:2',
                    'name' => 'required|alpha|max:255',
                ];
                break;
            case 'PUT':
                $rules = [
                    'name' => 'required|alpha|max:255',
                ];
                break;
            case 'GET':
            case 'DELETE':
                $rules = [];
                break;
       }

       return $rules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id.unique' => 'Este código ya esta en uso, prueba otro.',
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
