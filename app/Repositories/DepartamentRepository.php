<?php

namespace App\Repositories;

use App\Models\Departament;
use App\Repositories\Interfaces\DepartamentRepositoryInterface;

class DepartamentRepository implements DepartamentRepositoryInterface
{
     /**
     * Display a listing of the Departaments.
     * @param  int  $paginate
     * @return \Illuminate\Http\Response
     */
    public function getAllDepartaments($paginate=false, $inactive=null)
    {
        if ($paginate) {
            if ($inactive==null){
                return Departament::where('status', 1)->paginate($paginate);
            }
            else
                return Departament::paginate($paginate);
        }
        else {
             return Departament::where('status', 1)->get();
        }
    }

    /**
     * Display one Departament.
     * @param  int  $idDepartament
     * @return \Illuminate\Http\Response
     */
    public function getDepartamentById($departamentId)
    {
        return Departament::findOrFail($departamentId);
    }

    /**
     * Create or Update Departament.
     * @param  object  $departamentDetails
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdateDepartament($departamentDetails)
    {
        $departamentDetails->save();
        return $departamentDetails;
    }

     /**
     * Create or Update Departament.
     * @param  int  $idDepartament
     * @return booelan
     */
    public function deleteDepartament($departamentId)
    {
        $departament = Departament::find($departamentId);
        return $departament->delete();
    }

    public function rootDepartament()
    {
        return Departament::whereNull('parent_id')
        ->where('status',1)
        ->get();
    }

}
