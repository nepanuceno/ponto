<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use DB;

class PermissionController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:permissao-list|permissao-create|permissao-edit|permissao-delete', ['only' => ['index','store']]);
        $this->middleware('permission:permissao-create', ['only' => ['create','store']]);
        $this->middleware('permission:permissao-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permissao-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::orderBy('id','DESC')->paginate(5);
        return view('permissions.index',compact('permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
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
            'name' => 'required|unique:permissions|max:255',
        ]);

        try {
            Permission::create(['name' => $request->name]);
            return redirect()->route('permissions.index')->with('success', "Permissão Cadastrada com Sucesso!");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('permissions.index')->with('danger', "Erro ao tentar cadastrar a Permissão!". $th);
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
        $permission = Permission::find($id);
        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);

        return view('permissions.edit', compact('permission'));
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
            $permission = Permission::find($id)->get();

            $permission->name = $request->name;
            $permission->save();
            return redirect()->route('permissions.index')->with('success', "Permissão atualizada com sucesso!");
        } catch (\Throwable $th) {
            //throw $th;
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
        DB::table("permissions")->where('id',$id)->delete();
        return redirect()->route('permissions.index')
            ->with('success','Permissão excluída com sucesso!');
    }
}
