<?php

namespace App\Repositories\Interfaces;

interface DepartamentRepositoryInterface
{
    /**
     * Display a listing of the Departament.
     * @param  int  $paginate
     * @return \Illuminate\Http\Response
     */
    public function getAllDepartaments();

     /**
     * Display a listing of the Departament.
     * @param  int  $idDepartament
     * @return \Illuminate\Http\Response
     */
    public function getDepartamentById($id);

     /**
     * Create or Update Departament.
     * @param  object  $departamentDetails
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdateDepartament($departamentDetails);

    /**
     * Delete Departament.
     * @param  int  $idDepartament
     * @return booelan
     */
    public function deleteDepartament($id);
    public function rootDepartament();
}
