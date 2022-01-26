<?php
namespace App\Http\Controllers;

use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    private $roleRepositoryInterface;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(RoleRepositoryInterface $roleRepositoryInterface)
    {
        $this->roleRepositoryInterface = $roleRepositoryInterface;

        $this->middleware('permission:perfil-list|perfil-create|perfil-edit|perfil-delete', ['only' => ['index','store']]);
        $this->middleware('permission:perfil-create', ['only' => ['create','store']]);
        $this->middleware('permission:perfil-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:perfil-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = $this->roleRepositoryInterface->getAllRoles(5);
        return view('roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = $this->roleRepositoryInterface
                ->createRole(
                    ['name' => $request->input('name')],
                    $request->input('permission')
                );

        activity()
            ->withProperties(['new_role' => $role])
            ->log('Criou um novo perfil');

        return redirect()->route('roles.index')
            ->with('success','Perfil Criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->roleRepositoryInterface->getRole($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
        return view('roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->roleRepositoryInterface->getRole($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('roles.edit',compact('role','permission','rolePermissions'));

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
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = $this->roleRepositoryInterface->getRole($id);
        $role->name = $request->input('name');
        $this->roleRepositoryInterface->editRole($role);
        $this->roleRepositoryInterface->syncPermission($request->input('permission'), $role);

        activity()
            ->withProperties(['update_role' => $role])
            ->log('Editou o perfil <strong>'. $role->name.'</strong>');

        return redirect()->route('roles.index')
            ->with('success','Perfil atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role_name = $this->roleRepositoryInterface->deleteRole($id);

        activity()
            ->log('Excluiu o perfil'. $role_name);
        return redirect()->route('roles.index')
            ->with('success','Perfil excluído com sucesso!');
    }
}
