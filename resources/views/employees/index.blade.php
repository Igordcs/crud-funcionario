@php
    use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded shadow flex flex-col min-h-[600px]">
        <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <h1 class="text-3xl font-semibold text-gray-900">Funcionários</h1>

            <div class="flex flex-col md:flex-row items-stretch md:items-center gap-2 w-full md:w-auto">
                <form action="{{ route('employees.index') }}" method="GET" class="flex items-center gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nome, email ou CPF"
                        class="w-full md:w-64 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition">
                        Buscar
                    </button>
                </form>

                <a href="{{ route('employees.create') }}"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded flex items-center gap-2 transition justify-center"
                    type="button">
                    <i class="fas fa-plus fa-fw"></i>
                    <span class="hidden md:inline">Novo Funcionário</span>
                </a>
            </div>
        </header>

        <div class="flex-1 overflow-auto">
            <table class="w-full border border-gray-200 text-left text-gray-700" style="white-space: nowrap">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border-b border-gray-300 px-4 py-3">Nome</th>
                        <th class="border-b border-gray-300 px-4 py-3">CPF</th>
                        <th class="border-b border-gray-300 px-4 py-3">Data de Nascimento</th>
                        <th class="border-b border-gray-300 px-4 py-3">Telefone</th>
                        <th class="border-b border-gray-300 px-4 py-3">Gênero</th>
                        <th class="border-b border-gray-300 px-4 py-3 w-36">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr class="hover:bg-gray-50">
                            <td class="border-b border-gray-200 px-4 py-5">{{ $employee->user->name }}</td>
                            <td class="border-b border-gray-200 px-4 py-5">{{ $employee->cpf }}</td>
                            <td class="border-b border-gray-200 px-4 py-5">
                                {{ Carbon::parse($employee->birth_date)->format('d/m/Y') }}</td>
                            <td class="border-b border-gray-200 px-4 py-5">{{ $employee->phone_number }}</td>
                            <td class="border-b border-gray-200 px-4 py-5">
                                @php
                                    $genderMap = [
                                        'M' => 'Masculino',
                                        'F' => 'Feminino',
                                        'Other' => 'Outro',
                                    ];

                                    $employeeGender = $genderMap[$employee->gender] ?? 'Não informado';
                                @endphp
                                {{ $employeeGender }}
                            </td>
                            <td class="border-b border-gray-200 px-4 py-5 flex gap-3">
                                <button onclick="showEmployeeModal('modal-{{ $employee->id }}')" title="Visualizar"
                                    class="text-blue-600 hover:text-blue-800" aria-label="Visualizar funcionário">
                                    <i class="fas fa-eye fa-fw"></i>
                                </button>

                                <a href="{{ route('employees.edit', $employee) }}" title="Editar"
                                    class="text-yellow-600 hover:text-yellow-800" aria-label="Editar funcionário">
                                    <i class="fas fa-edit fa-fw"></i>
                                </a>

                                <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                    onsubmit="return confirm('Deseja realmente excluir?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Excluir" class="text-red-600 hover:text-red-800"
                                        aria-label="Excluir funcionário">
                                        <i class="fas fa-trash-alt fa-fw"></i>
                                    </button>
                                </form>

                                {{-- Modal de visualização do funcionário --}}
                                @include('employees.modal-view', ['employee' => $employee])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">Nenhum funcionário cadastrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <footer class="mt-6 border-t border-gray-200 pt-4">
            {{ $employees->links() }}
        </footer>
    </div>

    <script>
        function showEmployeeModal(modalId) {
            document.getElementById(modalId).classList.remove('modal-hidden');
        }

        function hideEmployeeModal(modalId) {
            document.getElementById(modalId).classList.add('modal-hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.modal-overlay').forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        console.log('Clicou no overlay, fechando modal');
                        this.classList.add('hidden');
                    }
                });
            });
        });
    </script>
@endsection
