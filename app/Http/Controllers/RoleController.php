<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function getAllPermissions(){

        return Permission::select('id','name',
        DB::raw("CONCAT(UPPER(SUBSTRING(REPLACE(name, '.', ' '),1,1)),LOWER(SUBSTRING(REPLACE(name, '.', ' '),2))) as display_name")
        )->get();

    }

    public function index()
    {
        if (!auth()->user()->can('roles.index')) {
            abort(403, 'Unauthorized action.');
        }
         $roles =Role::all();
        return view('admin.roles.index',compact('roles'));
    }


    public function create()
    {
         if (!auth()->user()->can('roles.create')) {
        abort(403, 'Unauthorized action.');
    }
         $permissions = $this->getAllPermissions();
        return view('admin.roles.create',compact('permissions'));
    }


    public function store(Request $request)
    {
        if (!auth()->user()->can('roles.store')) {
            abort(403, 'Unauthorized action.');
        }
        try {
            DB::beginTransaction();
            $role = Role::create(['name' => $request->name]);

            $role->syncPermissions($request->permissions);
            DB::commit();
            return redirect()->route('roles.create');

        } catch (Exception $e) {
            DB::rollBack();

        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        if (!auth()->user()->can('roles.edit')) {
            abort(403, 'Unauthorized action.');
        }
         $my_permissions = Role::with('permissions')->find($id);
        $all_permissions = $this->getAllPermissions();
        return view('admin.roles.edit',compact('my_permissions','all_permissions'));
    }


    public function update(Request $request, $id)
    {

        $this->validate($request, [

            'name' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $role = Role::find($id);

            $role->syncPermissions($request->input('permission'));
            $role->name = $request->name;
            $role->save();

            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Role updated successfully');
            
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Something Wrong');
        }
    }


    public function destroy($id)
    {
        //
    }

    public function delete(Request $request){

        try{
            Role::find($request->id)->delete();
            return response()->json(['msg'=>'Removed Sussesfully..']);
        }catch(Exception $ex){
            return response()->json(['msg'=>'Something Wrong..']);
        }


    }
}
