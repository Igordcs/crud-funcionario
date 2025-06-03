<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Exception;
use Hash;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search', null);


        $query = Employee::select('employees.*')
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->with('user');

        if ($search) {
            $digits = preg_replace('/[^0-9]/', '', $search);
            $hasDigits = !empty($digits);

            $query->where(function ($q) use ($search, $digits, $hasDigits) {
                $q->where('users.name', 'like', "%$search%")
                    ->orWhere('users.email', 'like', "%$search%");

                if ($hasDigits) {
                    $q->orWhere('employees.cpf', 'like', "%$digits%");
                }
            });
        }

        $employees = $query->paginate($perPage);

        return view('employees.index', [
            'employees' => $employees,
            'perPage' => $perPage,
            'page' => $request->input('page', 1),
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $cpf = preg_replace('/[^0-9]/', '', $validatedData['cpf']);
            $phoneNumber = preg_replace('/[^0-9]/', '', $validatedData['phone_number']);

            Employee::create([
                'user_id' => $user->id,
                'cpf' => $cpf,
                'birth_date' => $validatedData['birth_date'],
                'phone_number' => $phoneNumber,
                'gender' => $validatedData['gender'],
            ]);

            DB::commit();

            return redirect()->route('employees.index')->with('success', 'Funcionário criado com sucesso.');
        } catch (Exception $ex) {
            DB::rollBack();
            \Log::error('Erro ao criar funcionário:', ['error' => $ex->getMessage()]);
            return back()->withErrors(['error' => 'Erro ao criar funcionário: ' . $ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', ['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employees.create', ['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $validatedData = $request->validated();
        try {
            DB::beginTransaction();
            $employee->user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
            ]);

            // altera a senha se ela for passada
            if (!empty($validatedData['password'])) {
                $employee->user->update([
                    'password' => Hash::make($validatedData['password']),
                ]);
            }

            $cpf = preg_replace('/[^0-9]/', '', $validatedData['cpf']);
            $phoneNumber = preg_replace('/[^0-9]/', '', $validatedData['phone_number']);

            $employee->update([
                'cpf' => $cpf,
                'birth_date' => $validatedData['birth_date'],
                'phone_number' => $phoneNumber,
                'gender' => $validatedData['gender'],
            ]);

            DB::commit();
            return redirect()->route('employees.index')->with('success', 'Funcionário atualizado com sucesso.');
        } catch (Exception $ex) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao atualizar funcionário: ' . $ex->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            DB::beginTransaction();
            $user = $employee->user;
            $employee->delete();
            $user->delete();
            DB::commit();
            return redirect()->route('employees.index')->with('success', 'Funcionário excluído com sucesso.');
        } catch (Exception $ex) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao excluir funcionário: ' . $ex->getMessage()]);
        }
    }
}
