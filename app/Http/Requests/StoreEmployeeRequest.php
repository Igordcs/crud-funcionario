<?php

namespace App\Http\Requests;

use App\Rules\cpfValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:50'],
            'cpf' => ['required', 'string', new cpfValidationRule(), 'unique:employees,cpf'],
            'birth_date' => ['required', 'date'],
            'phone_number' => ['required', 'string', 'min:10', 'max:20'],
            'gender' => ['required', 'string', 'in:M,F,Other'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.min' => 'O nome deve ter no mínimo :min caracteres.',
            'name.max' => 'O nome deve ter no máximo :max caracteres.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está em uso.',

            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
            'password.max' => 'A senha deve ter no máximo :max caracteres.',

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está em uso.',

            'birth_date.required' => 'A data de nascimento é obrigatória.',
            'birth_date.date' => 'A data de nascimento deve ser uma data válida.',

            'phone_number.required' => 'O número de telefone é obrigatório.',
            'phone_number.min' => 'O número de telefone deve ter no mínimo :min caracteres.',
            'phone_number.max' => 'O número de telefone deve ter no máximo :max caracteres.',

            'gender.required' => 'O gênero é obrigatório.',
            'gender.in' => 'O gênero deve ser M, F ou Other.',
        ];
    }
}
