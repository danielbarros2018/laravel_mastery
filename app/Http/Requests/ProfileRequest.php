<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $rules = [
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email,' . auth()->id()
        ];
                
        if (request()->get('user')['password']) {
            $rules['user.password'] = 'string|min:8|confirmed';
        }
        
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório!',
            'min' => 'A senha deve ter no mínimo :min caracteres!',
            'confirmed' => 'A confirmação da senha não é igual a senha',
            'unique' => 'Este email já está sendo utilizado por outro usuário'
        ];
    }
}
