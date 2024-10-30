<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id'     => 'required',
            'device'        => 'required | string | max:90',
            'brand'         => 'required | string | max:90',
            'model'         => 'nullable | string | max:90',
            'serial_number' => 'nullable | string | max:90',
            'description'   => 'nullable | string',
            'price'         => 'required | numeric | decimal:2'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string> 
     */
    public function messages(): array
    {
        return [

            'client_id' => [
                'required' => 'É necessário selecionar um cliente!'
            ],

            'device' => [
                'required' => 'É necessário informar o dispositivo!',
                'max' => 'Não pode passar de 90 caracteres',
            ],

            'brand' => [
                'required' => 'É necessário informar a marca!',
                'max' => 'Marca não pode passar de 90 caracteres',
            ],

            'model' => [
                'max' => 'Modelo não pode passar de 90 caracteres',
            ],

            'serial_number' => [
                'max' => 'Número de série não pode passar de 90 caracteres',
            ],

            'price' => [
                'required' => 'É necessário informar o preço!',
                'numeric' => 'Valor deve conter apenas números!',
                'decimal' => 'Valor deve haver 2 valores decimais!'
            ],
            
        ];
    }
}
