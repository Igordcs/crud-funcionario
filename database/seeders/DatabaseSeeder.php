<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
        ]);

        $this->createEmployees();
    }

    private function createEmployees()
    {
        $employees = [
            [
                'name' => 'João Silva',
                'email' => 'joao.silva@empresa.com',
                'cpf' => '123.456.789-01',
                'birth_date' => '1985-05-15',
                'phone_number' => '(11) 98765-4321',
                'gender' => 'M',
            ],
            [
                'name' => 'Maria Oliveira',
                'email' => 'maria.oliveira@empresa.com',
                'cpf' => '987.654.321-09',
                'birth_date' => '1990-08-22',
                'phone_number' => '(11) 91234-5678',
                'gender' => 'F',
            ],
            [
                'name' => 'Carlos Souza',
                'email' => 'carlos.souza@empresa.com',
                'cpf' => '456.789.123-45',
                'birth_date' => '1988-11-30',
                'phone_number' => '(11) 99876-5432',
                'gender' => 'M',
            ],
            [
                'name' => 'Ana Santos',
                'email' => 'ana.santos@empresa.com',
                'cpf' => '789.123.456-78',
                'birth_date' => '1992-03-10',
                'phone_number' => '(11) 94567-8912',
                'gender' => 'F',
            ],
            [
                'name' => 'Pedro Costa',
                'email' => 'pedro.costa@empresa.com',
                'cpf' => '321.654.987-32',
                'birth_date' => '1983-07-18',
                'phone_number' => '(11) 92345-6789',
                'gender' => 'M',
            ],
        ];

        foreach ($employees as $employeeData) {
            $user = User::create([
                'name' => $employeeData['name'],
                'email' => $employeeData['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('func123'),
                'remember_token' => Str::random(10),
            ]);

            Employee::create([
                'user_id' => $user->id,
                'cpf' => $employeeData['cpf'],
                'birth_date' => $employeeData['birth_date'],
                'phone_number' => $employeeData['phone_number'],
                'gender' => $employeeData['gender'],
            ]);
        }
    }
}