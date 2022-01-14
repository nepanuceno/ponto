<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
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
        $positions =  Position::paginate(20);

        return view('positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('positions.create');
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
            'name' => 'required|unique:positions|max:255',
        ]);

        try {
            //code...
            $position = new Position();
            $position->name = $request->position;
            $position->save();
            return redirect()->route('positions.index')->with('success', 'Cargo criado com sucesso!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('positions.index')->with('danger', 'Erro ao criar Cargo!'.PHP_EOL . $th->getMessage());
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
        $position = Position::find($id);
        return view('positions.create', compact('position'));
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
            $position = Position::find($id);

            $position->name = $request->position;
            $position->save();

            return redirect()->route('positions.index')->with('success', 'Cargo atualizado!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('positions.create')->with('danger', 'Erro ao criar cargo!'. PHP_EOL . $th->getMessage());
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
        //
    }
}
