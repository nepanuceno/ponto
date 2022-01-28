<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
     /**
     * Display a listing of the Employees.
     * Params paginate and tag active 1|0
     * @param  int  $paginate
     * @param  int  $tag
     * @return \Illuminate\Http\Response
     */
    public function getAllEmployees($paginate=false, $tag)
    {
        if ($paginate) {
             return Employee::where('active', $tag)->paginate($paginate);
        }
        else {
             return Employee::where('active', $tag)->get();
        }
    }

    /**
     * Display one Employee.
     * @param  int  $idEmployee
     * @return \Illuminate\Http\Response
     */
    public function getEmployeeById($employeeId)
    {
        return Employee::findOrFail($employeeId);
    }

    /**
     * Create or Update Employee.
     * @param  object  $employeeDetails
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdateEmployee($employeeDetails)
    {
        $employeeDetails->save();
        return $employeeDetails;
    }

     /**
     * Create or Update Employee.
     * @param  int  $idEmployee
     * @return booelan
     */
    public function deleteEmployee($employeeId)
    {
        $employee = Employee::find($employeeId);
        return $employee->delete();
    }
}
