<?php

namespace App\Repositories;

use App\Models\Position;
use App\Repositories\Interfaces\PositionRepositoryInterface;

class PositionRepository implements PositionRepositoryInterface
{
     /**
     * Display a listing of the Positions.
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
     * Display one Position.
     * @param  int  $idPosition
     * @return \Illuminate\Http\Response
     */
    public function getPositionById($positionId)
    {
        return Position::findOrFail($positionId);
    }

    /**
     * Create or Update Position.
     * @param  object  $positionDetails
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdatePosition($positionDetails)
    {
        $positionDetails->save();
        return $positionDetails;
    }

     /**
     * Create or Update Position.
     * @param  int  $idPosition
     * @return booelan
     */
    public function deletePosition($positionId)
    {
        $position = Position::find($positionId);
        return $position->delete();
    }
}
