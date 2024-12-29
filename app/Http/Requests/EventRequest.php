<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required|string|max:255|min:5',
            'start_date' => 'required|date|after:today',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O tamanho mínimo é :min caracteres',
            'max' => 'O tamanho é :max caracteres',
            'string' => 'Este campo deve ser uma string',
            'date' => 'Este campo deve ser uma data',
            'after' => 'A data deve ser maior que a data atual',
        ];
    }
}
