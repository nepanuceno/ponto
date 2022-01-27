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
     * Create or Update Position.
     * @param  object  $positionDetails
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdatePosition($positionDetails);

    /**
     * Delete Position.
     * @param  int  $idPosition
     * @return booelan
     */
    public function deletePosition($id);
}
