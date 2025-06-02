<div id="modal-{{ $employee->id }}"
    class="modal-overlay modal-hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-3xl relative shadow-lg transform transition-all duration-300 ease-out">
        <button onclick="hideEmployeeModal('modal-{{ $employee->id }}')"
            class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-xl" type="button"
            aria-label="Fechar modal">
            <i class="fas fa-times"></i>
        </button>

        <h2 class="text-2xl font-semibold mb-4">Visualizar Funcionário</h2>

        @include('employees.form', ['employee' => $employee, 'viewMode' => true])

        <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
            <button type="button" onclick="hideEmployeeModal('modal-{{ $employee->id }}')"
                class="cancel-btn">
                Fechar
            </button>
        </div>
    </div>
</div>
