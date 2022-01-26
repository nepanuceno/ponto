<?php

namespace App\Repositories\Interfaces;

interface PositionRepositoryInterface
{
    /**
     * Display a listing of the Position.
     * @param  int  $paginate
     * @return \Illuminate\Http\Response
     */
    public function getAllPositions();

     /**
     * Display a listing of the Position.
     * @param  int  $idPosition
     * @return \Illuminate\Http\Response
     */
    public function getPositionById($id);

     /**
     * Display a listing of the Position.
     * @param  object  $positionDetails
     * @return \Illuminate\Http\Response
     */
    public function createPosition($positionDetails);

    public function updatePosition($positionNewDetails);
    public function deletePosition($id);
}
