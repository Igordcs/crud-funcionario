@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6">{{ isset($employee) ? 'Editar Funcionário' : 'Cadastrar Funcionário' }}</h1>
        <form action="{{ isset($employee) ? route('employees.update', $employee) : route('employees.store') }}"
            method="POST">
            @csrf
            @if (isset($employee))
                @method('PUT')
            @endif

            @include('employees.form')

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <a type="button" id="cancelBtn" href="{{ route('employees.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Voltar
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-save mr-2"></i>Salvar
                </button>
            </div>
        </form>
    </div>
@endsection
