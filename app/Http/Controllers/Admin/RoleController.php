<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate();
        return view('admin.roles.index', compact('roles'));
    }
    
    public function create()
    {
        $permissions = Permission::get();
        return view('admin.roles.create', compact('permissions'));
    }
    
    public function store(Request $request)
    {   
        $role = Role::create($request->except(['special','permissions']));
       if ($request->get('special') == 'all-access') {

           $role->givePermissionTo(Permission::all());
        }else{

            $role->givePermissionTo($request->get('permissions'));
        }
                           
        $role->syncPermissions($request->get('permissions'));
        //$permission = Permission::create(['name' => 'edit articles']);

        //$role->permissions()->sync($request->get('permissions'));
        return redirect()->route('roles.edit', $role->id)
            ->with('info', 'Rol guardado con éxito');
    }
    
    
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }
    
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->update($request->except(['special','permissions']));
        $role->givePermissionTo($request->get('permissions'));
        $role->syncPermissions($request->get('permissions'));
        //$role->permissions()->sync($request->get('permissions'));
        return redirect()->route('roles.edit', $role->id)
            ->with('info', 'Rol guardado con éxito');
    }
    
    public function destroy($id)
    {
        $role = Role::find($id)->delete();
        //$role->revokePermissionTo('edit articles');
        return back()->with('info', 'Eliminado correctamente');
    }
}
