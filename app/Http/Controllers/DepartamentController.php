<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use App\Repositories\Interfaces\DepartamentRepositoryInterface;
use Illuminate\Http\Request;

class DepartamentController extends Controller
{
    private $departament;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(DepartamentRepositoryInterface $departamentRepositoryInterface)
    {
        $this->departament = $departamentRepositoryInterface;
        $this->middleware('permission:servidor-list|servidor-create|servidor-edit|servidor-delete', ['only' => ['index','store']]);
        $this->middleware('permission:servidor-create', ['only' => ['create','store']]);
        $this->middleware('permission:servidor-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:servidor-delete', ['only' => ['destroy']]);
    }

    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $departaments = Departament::where('status', 1)->paginate(10);
        $departaments = $this->departament->getAllDepartaments(10);
        return view('departaments.index', compact('departaments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $departaments = Departament::where('status', 1)->get();
        $departaments = $this->departament->getAllDepartaments();
        return view('departaments.create', compact('departaments'));
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
            'name' => 'required|unique:departaments|max:255',
        ]);

        $departament = new Departament();

        $departament->name = $request->name;
        $departament->parent_id = $request->parent;
        // $departament->save();

        $this->departament->createOrUpdateDepartament($departament);

        activity()
            ->withProperties(['new_departament' => $departament])
            ->log('Criou o novo departamento - '.$departament->name);

        return redirect()->route('departaments.index')->with('success','Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departament = $this->departament->getDepartamentById($id);
        $root = $this->departament->rootDepartament()[0];
        $output = $this->output($root->descendants, $departament);

        $output = "<ul class=\"tree\"><li><code>".$root->name."</code>".$output."</li></ul>";

        return view('departaments.show', compact('output','departament'));
    }

    public function output($projects, $departament)
    {
                $string = "<ul>";
                foreach ($projects as $i => $project) {
                    $string .= "<li>";
                    $string .= "<code>".$project['name']."</code>";
                    if (count($project['children'])) {
                        $string .= $this->output($project['children'], $departament);
                    }
                    $string .= "</li>";
                }
                $string .= "</ul>";
        return $string;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $departament = Departament::find($id);
        $departament = $this->departament->getDepartamentById($id);
        // $departaments = Departament::where('status', 1)->get();
        $departaments = $this->departament->getAllDepartaments();

        return view('departaments.create', compact('departament', 'departaments'));
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
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        // $departament = Departament::find($id);
        $departament = $this->departament->getDepartamentById($id);
        $old_name = $departament->name;
        $departament->name = $request->name;
        $departament->parent_id = $request->parent;
        // $departament->save();
        $this->departament->createOrUpdateDepartament($departament);

        activity()
            ->withProperties(['update_departament' => $departament])
            ->log('Alerou o departamento - '.$old_name . ' para '.$request->name);

        return redirect()->route('departaments.index')->with('success','Editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $departament = Departament::find($id);
        $departament = $this->departament->getDepartamentById($id);
        if ($departament->status) {
            $departament->status = 0;
            // $departament->save();
            $this->departament->createOrUpdateDepartament($departament);
        }

        activity()
            ->withProperties(['active_departament' => $departament])
            ->log('Desativou o Departamento '.$departament->name);


        return redirect()->route('departaments.index')->with('success','Departamento desativado com sucesso!');
    }
}
