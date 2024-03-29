<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use App\Models\Departament;
use App\Repositories\Interfaces\DepartamentRepositoryInterface;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    private $employee;
    private $departaments;
    private $roles;
    private $positions;
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(
        EmployeeRepositoryInterface $employeeRepositoryInterface,
        DepartamentRepositoryInterface $departamentRepositoryInterface,
        RoleRepositoryInterface $roleRepositoryInterface,
        PositionRepositoryInterface $positionRepositoryInterface
        )
    {
        $this->employee = $employeeRepositoryInterface;
        $this->departaments = $departamentRepositoryInterface;
        $this->roles = $roleRepositoryInterface;
        $this->positions = $positionRepositoryInterface;

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
        if (session()->has('active') && session('active')==0) {
           $tag = 0;
        } else {
            $tag = 1;
        }

        // $employees  = Employee::where('active', $tag) ->paginate(20);
        $employees = $this->employee->getAllEmployees(20, $tag);
        session()->forget('active');
        session(['active' => $tag]);

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Response $response)
    {
        // $departaments = Departament::orderBy('name', 'ASC')->get();
        $departaments = $this->departaments->getAllDepartaments();
        // $positions = Position::orderBy('name', 'ASC')->get();
        $positions = $this->positions->getAllPositions();

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
        $validated = $request->validate([
            'name' => 'required|unique:employees|max:255',
            'telephone' => 'required|unique:employees|max:20',
            'email' => 'required|unique:employees|max:55',
            'matriculation' => 'required|unique:employees|max:25',
            'departament' => 'required',
            'position' => 'required',
        ]);

        try {
            $employee = new Employee();

            $employee->name = $request->name;
            $employee->matriculation = $request->matriculation;
            $employee->telephone = $request->telephone;
            $employee->email = $request->email;
            $employee->departament_id = $request->departament;
            $employee->position_id = $request->position;

            // $employee->save();
            $this->employee->createOrUpdateEmployee($employee);

            activity()
            ->withProperties(['new_employee' => $employee])
            ->log('Criou um novo Servidor');

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
        try {
            // $employee = Employee::where('id', $id)->first();
            $employee = $this->employee->getEmployeeById($id);
            return view('employees.show', compact('employee'));
        } catch (\Throwable $th) {
            return redirect()->route('employees.index')->with('danger','Erro ao consultar Servidor!'.$th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $employee = Employee::find($id);
        // $departaments = Departament::all();
        // $positions = Position::all();


        $employee = $this->employee->getEmployeeById($id);
        $departaments = $this->departaments->getAllDepartaments();
        $positions = $this->positions->getAllPositions();

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
            // $employee = Employee::find($id);
            $employee = $this->employee->getEmployeeById($id);

            $employee->name = $request->name;
            $employee->matriculation = $request->matriculation;
            $employee->telephone = $request->telephone;
            $employee->email = $request->email;
            $employee->departament_id = $request->departament;
            $employee->position_id = $request->position;

            // $employee->save();
            $employee = $this->employee->createOrUpdateEmployee($employee);

            activity()
                ->withProperties(['update_employee' => $employee])
                ->log('Alterou o Servidor '. $employee->name);

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
            // $employee = Employee::find($id);
            $employee = $this->employee->getEmployeeById($id);

            if ($employee->active == 1) {
                $employee->active = 0;
                $str_active = 'Desativou';

            } else {
                $employee->active = 1;
                $str_active = 'Ativou';
            }
            // $employee->save();
            $this->employee->createOrUpdateEmployee($employee);

            activity()
                ->withProperties(['active_employee' => $employee])
                ->log($str_active.' o Servidor '. $employee->name);

            return redirect()->route('employees.index')->with('success','Servidor desativado com sucesso!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('employees.index')->with('danger','Erro ao desativar Servidor!'.PHP_EOL.$th->getMessage());

        }
    }

    public function changeActiveSearchEmployees()
    {
        //Se a sessao nao existe ou se ela existe e é igual a 1, passa pra 0;
        $session = session('active');
        session()->forget('active');

        if ($session==1) {
            session(['active' => 0]);
        } else {
            session(['active' => 1]);
        }

        return redirect()->route('employees.index');
    }
}
