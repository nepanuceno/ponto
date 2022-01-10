<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:servidor-list|servidor-create|servidor-edit|servidor-delete', ['only' => ['index','store']]);
        $this->middleware('permission:servidor-create', ['only' => ['create','store']]);
        $this->middleware('permission:servidor-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:servidor-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees  = Employee::where('active', 1)->paginate(20);

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departaments = Departament::all();
        $positions = Position::all();

        return view('employees.create', compact('departaments','positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $employee = new Employee();

            $employee->name = $request->employee;
            $employee->matriculation = $request->matriculation;
            $employee->departament_id = $request->departament;
            $employee->position_id = $request->position;

            $employee->save();

            return redirect()->route('employees.index')->with('success','Servidor cadastrado com sucesso!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('employees.create')->with('danger','Erro ao cadastrar Servidor!'.PHP_EOL.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        $departaments = Departament::all();
        $positions = Position::all();

        return view('employees.create', compact('employee', 'departaments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $employee = Employee::find($id);

            $employee->name = $request->employee;
            $employee->matriculation = $request->matriculation;
            $employee->departament_id = $request->departament;
            $employee->position_id = $request->position;

            $employee->save();

            return redirect()->route('employees.index')->with('success','Servidor atualizado com sucesso!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('employees.create')->with('danger','Erro ao editar Servidor!'.PHP_EOL.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $employee = Employee::find($id);

            if ($employee->active) {
                $employee->active = 0;
                $employee->save();
            }

            return redirect()->route('employees.index')->with('success','Servidor desativado com sucesso!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('employees.index')->with('danger','Erro ao desativar Servidor!'.PHP_EOL.$th->getMessage());

        }
    }
}
