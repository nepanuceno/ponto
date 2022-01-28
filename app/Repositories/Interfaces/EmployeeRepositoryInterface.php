<?php

namespace App\Repositories\Interfaces;

interface EmployeeRepositoryInterface
{
    /**
     * Display a listing of the Employee.
     * @param  int  $paginate
     * @param  int  $tag_active 1|0
     * @return \Illuminate\Http\Response
     */
    public function getAllEmployees($paginate, $tag_active);

     /**
     * Display a listing of the Employee.
     * @param  int  $idEmployee
     * @return \Illuminate\Http\Response
     */
    public function getEmployeeById($id);

     /**
     * Create or Update Employee.
     * @param  object  $employeeDetails
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdateEmployee($employeeDetails);

    /**
     * Delete Employee.
     * @param  int  $idEmployee
     * @return booelan
     */
    public function deleteEmployee($id);
}
