<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="col-span-2">
        <label for="name" class="block text-sm font-medium text-gray-700">Nome Completo</label>
        @if (isset($viewMode) && $viewMode)
            <p class="mt-1 p-2 bg-gray-100 rounded">{{ $employee->user->name ?? '' }}</p>
        @else
            <input type="text" name="name" id="name" required placeholder="Fulano da Silva"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('name', $employee->user->name ?? '') }}">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        @endif
    </div>
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
        @if (isset($viewMode) && $viewMode)
            <p class="mt-1 p-2 bg-gray-100 rounded">{{ $employee->user->email ?? '' }}</p>
        @else
            <input type="email" name="email" id="email" required placeholder="email@example.com"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('email', $employee->user->email ?? '') }}">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        @endif
    </div>
    @unless (isset($employee))
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
            @if (isset($viewMode) && $viewMode)
                <p class="mt-1 p-2 bg-gray-100 rounded">••••••••</p>
            @else
                <input type="password" name="password" id="password" required placeholder="*******"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            @endif
        </div>
    @endunless
    <div>
        <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
        @if (isset($viewMode) && $viewMode)
            <p class="mt-1 p-2 bg-gray-100 rounded">{{ $employee->cpf ?? '' }}</p>
        @else
            <input type="text" name="cpf" id="cpf" required placeholder="000.000.000-00"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('cpf', $employee->cpf ?? '') }}">
            @error('cpf')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        @endif
    </div>
    <div>
        <label for="birth_date" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
        @if (isset($viewMode) && $viewMode)
            <p class="mt-1 p-2 bg-gray-100 rounded">
                {{ $employee->birth_date ? \Carbon\Carbon::parse($employee->birth_date)->format('d/m/Y') : '' }}</p>
        @else
            <input type="date" name="birth_date" id="birth_date" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('birth_date', $employee->birth_date ?? '') }}">
            @error('birth_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        @endif
    </div>
    <div>
        <label for="phone_number" class="block text-sm font-medium text-gray-700">Telefone</label>
        @if (isset($viewMode) && $viewMode)
            <p class="mt-1 p-2 bg-gray-100 rounded">{{ $employee->phone_number ?? '' }}</p>
        @else
            <input type="text" name="phone_number" id="phone_number" required placeholder="(00) 0 0000-0000"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('phone_number', $employee->phone_number ?? '') }}" maxlength="15">
            @error('phone_number')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        @endif
    </div>
    <div>
        <label for="gender" class="block text-sm font-medium text-gray-700">Gênero</label>
        @if (isset($viewMode) && $viewMode)
            @php
                $genderLabels = [
                    'M' => 'Masculino',
                    'F' => 'Feminino',
                    'Other' => 'Outro',
                ];
            @endphp
            <p class="mt-1 p-2 bg-gray-100 rounded">{{ $genderLabels[$employee->gender] ?? $employee->gender }}</p>
        @else
            <select name="gender" id="gender" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option value="">Selecione...</option>
                <option value="M" {{ old('gender', $employee->gender ?? '') == 'M' ? 'selected' : '' }}>Masculino
                </option>
                <option value="F" {{ old('gender', $employee->gender ?? '') == 'F' ? 'selected' : '' }}>Feminino
                </option>
                <option value="Other" {{ old('gender', $employee->gender ?? '') == 'Other' ? 'selected' : '' }}>Outro
                </option>
            </select>
            @error('gender')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cpfInput = document.getElementById('cpf');
        const phoneInput = document.getElementById('phone_number');

        function maskCPF(value) {
            return value
                .replace(/\D/g, '')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        }

        function maskPhone(value) {
            return value
                .replace(/\D/g, '')
                .replace(/(\d{2})(\d)/, '($1) $2')
                .replace(/(\d{4,5})(\d{4})$/, '$1-$2');
        }

        if (cpfInput) {
            cpfInput.addEventListener('input', function(e) {
                e.target.value = maskCPF(e.target.value);
            });
        }

        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                e.target.value = maskPhone(e.target.value);
            });
        }
    });
</script>
