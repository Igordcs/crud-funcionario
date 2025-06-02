@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <x-module-card
                    href="{{ route('employees.index') }}"
                    icon="fas fa-users"
                    iconBg="bg-blue-100"
                    iconColor="text-blue-600"
                    title="Funcionários"
                    description="Gerenciar cadastro de funcionários"
                />
            </div>
        </div>
    </div>
@endsection