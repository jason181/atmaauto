<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return response()->json(Role::all(),200);
    }

    public function store(Request $request)
    {
        $job = Role::create([
            'Nama_Role' => $request->Nama_Role,
        ]);

        return response()->json([
            'status' => (bool) $role,
            'data' => $role,
            'message' => $role ? 'Success' : 'Error Role'
        ]);
    }

    public function update(Request $request, $id)
    {   
        $role = Role::find($id);

        if(!is_null($request->Nama_Role)){
            $role->Nama_Role = $request->Nama_Role;
        }

        $success = $role->save();
        if(!$success){
            return response()->json('Error Update',500);
        }else   
            return response()->json('Success',200);
    }

    public function showbyID($id)
    {
        $role = Role::find($id);
        return response()->json($role,200);
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $status = $role->delete();
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Deleted' : 'Error Delete'
        ]);
    } 
}
