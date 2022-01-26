<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    private $position;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(PositionRepositoryInterface $positionRepositoryInterface)
    {
        $this->position = $positionRepositoryInterface;

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
        // $positions =   Position::paginate(20);
        $positions = $this->position->getAllPositions(20);

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
            $position->name = $request->name;
            // $position->save();

            $this->position->createPosition($position);

            activity()
            ->withProperties(['new_position' => $position])
            ->log('Criou um novo Cargo - '.$position->name);

            return redirect()->route('positions.index')->with('success', 'Cargo criado com sucesso!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('positions.index')->with('danger', 'Erro ao criar Cargo!'.PHP_EOL . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idPosition
     * @return \Illuminate\Http\Response
     */
    public function show($idPosition)
    {
        // return Position::find($idPosition);
        return $this->position->getPositionById($idPosition);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $position = Position::find($id);
        $position = $this->position->getPositionById($id);
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
            // $position = Position::find($id);
            $position = $this->position->getPositionById($id);

            $old_name = $position->name;
            $new_name = $request->name;

            $position->name = $request->name;

            $this->position->updatePosition($position);
            // $position->save();

            activity()
            ->withProperties(['update_position' => $position])
            ->log('Alterou o nome do Cargo '.$old_name . ' para '.$new_name);

            return redirect()->route('positions.index')->with('success', 'Cargo atualizado!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('positions.create')->with('danger', 'Erro ao criar cargo!'. PHP_EOL . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idPosition
     * @return \Illuminate\Http\Response
     */
    public function destroy($idPosition)
    {
        $this->position->deletePosition($idPosition);
    }
}
