<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\permissions;
use App\Models\PermissionsName;
use App\Models\Roles;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.layout.dashboard');
    }
   
    public function Role()
    {
        $roles = Roles::with('permissions')->where('name' , "!=", "Admin")->where('name' , "!=", "Client")->paginate(10);
        $permissions = PermissionsName::all();
        return view('admin.layout.permission.role' , compact('roles' , 'permissions'));
    }
   
    public function createRole(Request $request)
    {
        $request->validate([
            "name" => "required|unique:roles",
            "per_id" => "required"
        ]);


        Roles::create([
            "name" => $request->name,
        ]);

        $Role = Roles::where('name' , $request->name)->first();
        $Role_id = $Role->id;

        foreach ($request->per_id as $per_id)
        {
            permissions::create([
                "role_id" => $Role_id,
                "permission_id" => $per_id,
            ]);
        }


        return redirect()->back()->with('success' , 'Role has been created successfully');
    }
    public function updateRole(Request $request )
    {
        $permission = Roles::find($request->id);
        $permission->update([
            "name" => $request->name,
        ]);

        return redirect()->back()->with('success' , 'Role has been updated successfully');
    }

    public function destroyRole($id)
    {
        $permission = Roles::find($id);
        $permission->delete();

        return redirect()->back()->with('success' , 'Role has been deleted successfully');
    }


    public function getroles($id)
    {
        $permission = permissions::with('permissionName')->where('role_id' , $id)->get();
        return response()->json($permission);
    }


}