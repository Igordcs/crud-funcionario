<?php

namespace App\Http\Requests;

use App\Rules\cpfValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $employee = $this->route('employee'); // Pega o employee da rota

        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($employee->user_id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'max:50'],
            'cpf' => [
                'required',
                'string',
                new cpfValidationRule(),
                Rule::unique('employees', 'cpf')->ignore($employee->id),
            ],
            'birth_date' => ['required', 'date'],
            'phone_number' => ['required', 'string', 'min:10', 'max:20'],
            'gender' => ['required', 'string', 'in:M,F,Other'],
        ];
    }

    public function messages(): array
    {
        // Use as mensagens do StoreEmployeeRequest ou repita se quiser personalizar
        return (new StoreEmployeeRequest())->messages();
    }
}
