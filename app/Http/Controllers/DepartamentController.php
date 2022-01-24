<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use Illuminate\Http\Request;

class DepartamentController extends Controller
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
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departaments = Departament::where('status', 1)->paginate(10);
        return view('departaments.index', compact('departaments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departaments = Departament::where('status', 1)->get();
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
        $departament->save();

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
        $departament = Departament::find($id);
        $departaments = Departament::where('status', 1)->get();

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
            'name' => 'required|unique:departaments|max:255',
        ]);

        $departament = Departament::find($id);
        $old_name = $departament->name;
        $departament->name = $request->name;
        $departament->parent_id = $request->parent;
        $departament->save();

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
        $departament = Departament::find($id);
        if ($departament->status) {
            $departament->status = 0;
            $departament->save();
        }

        activity()
            ->withProperties(['active_departament' => $departament])
            ->log('Desativou o Departamento '.$departament->name);


        return redirect()->route('departaments.index')->with('success','Departamento desativado com sucesso!');
    }
}
