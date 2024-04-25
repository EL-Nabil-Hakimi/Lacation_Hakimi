<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\permissions;
use App\Models\PermissionsName;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.layout.dashboard');
    }
   
    public function Role()
    {
        $roles = Roles::with('permissions')->whereNot('id', 1)->whereNot('id' , 3)->paginate(10);
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
    public function updateRole(Request $request)
    {
        $request->validate([
            "name" => "required|unique:roles,name," . $request->id,
            "per_id" => "required|array",
        ]);
    
        $role = Roles::find($request->id);
    
        if ($role) {
            $role->name = $request->name;
            $role->save(); 
            permissions::where('role_id', $request->id)->delete();
    

            foreach ($request->per_id as $per_id) {
                permissions::create([
                    "role_id" => $request->id,
                    "permission_id" => $per_id,
                ]);
            }
    
            return redirect()->back()->with('success', 'Le rôle a été mis à jour avec succès');
        } else {
            return redirect()->back()->with('error', 'Le rôle n\'existe pas!');
        }
    }
    

    public function destroyRole($id)
    {
        $permission = Roles::find($id);
        $permission->delete();

        return redirect()->back()->with('success' , 'Role has been deleted successfully');
    }


    public function getPermission($id)
    {
        $permissions = PermissionsName::with('permissions')->get();
        // dd($permissions);
        return response()->json($permissions);
    }
    

}