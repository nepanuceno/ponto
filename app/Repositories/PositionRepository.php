<?php

namespace App\Repositories;

use App\Models\Position;
use App\Repositories\Interfaces\PositionRepositoryInterface;

class PositionRepository implements PositionRepositoryInterface
{
     /**
     * Display a listing of the resource.
     * @param  int  $paginate
     * @return \Illuminate\Http\Response
     */
    public function getAllPositions($paginate=false)
    {
        if ($paginate) {
             return Position::paginate($paginate);
        }
        else {
             return Position::all();
        }
    }


    /**
     * Display a listing of the Position.
     * @param  int  $idPosition
     * @return \Illuminate\Http\Response
     */
    public function getPositionById($positionId)
    {
        return Position::findOrFail($positionId);
    }

    /**
     * Display a listing of the Position.
     * @param  object  $positionDetails
     * @return \Illuminate\Http\Response
     */
    public function createPosition($positionDetails)
    {
        $position = Position::create($positionDetails);
        return $position;
    }



    public function updatePosition($positionNewDetails)
    {
        return $positionNewDetails->save();

    }


    public function deletePosition($positionId)
    {
        $position = Position::find($positionId);
        $position->delete();
    }
}
