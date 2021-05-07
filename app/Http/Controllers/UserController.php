<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function getAllPermissions(){

        return Permission::select('id','name',
        DB::raw("CONCAT(UPPER(SUBSTRING(REPLACE(name, '.', ' '),1,1)),LOWER(SUBSTRING(REPLACE(name, '.', ' '),2))) as display_name")
        )->get();

    }

    public function index()
    {
        if (!auth()->user()->can('users.index')) {
            abort(403, 'Unauthorized action.');
        }

        $users =User::paginate(10);
        return view('admin.users.index',compact('users'));
    }

    public function create()
    {
        if (!auth()->user()->can('users.create')) {
            abort(403, 'Unauthorized action.');
        }
        $roles =Role::all();
        $permissions = $this->getAllPermissions();
        return view('admin.users.create',compact('roles','permissions'));
    }


    public function store(Request $request)
    {
        if (!auth()->user()->can('users.store')) {
            abort(403, 'Unauthorized action.');
        }
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            // 'password' => 'required|same:confirm-password',
            // 'roles' => 'required'
        ]);

        $input = $request;
        $input['password'] = Hash::make('Abcd@1234');
        try{
            DB::beginTransaction();
            $user = User::create($input->all());
            $user->assignRole($input['roles']);
            $user->givePermissionTo($input['permissions']);
            DB::commit();
            return redirect()->route('users.index')
                            ->with('success','User created successfully');
        }catch(Exception $e){
            DB::rollBack();

        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        if (!auth()->user()->can('users.edit')) {
            abort(403, 'Unauthorized action.');
        }
         $users = User::with('roles')->where('id',$id)->first();
         $all_permissions = $this->getAllPermissions();
         $my_permissions = User::with('permissions')->where('id',$id)->first();;
        $roles =Role::all();
        return view('admin.users.edit',compact('users','roles','my_permissions','all_permissions'));

    }


    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('users.update')) {
            abort(403, 'Unauthorized action.');
        }
        try {
        DB::beginTransaction();

        $user = User::find($id);
        // $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));
        $user->syncPermissions($request->input('permissions'));
        DB::commit();
        return redirect()->route('users.index')->with('success', 'User updated successfully');

        }catch(Exception $e){

            DB::rollBack();
            return redirect()->back()->with('error', 'Something Wrong');

        }
    }

    public function destroy($id)
    {
        //
    }
    public function block(Request $request)
    {
        if (!auth()->user()->can('users.block')) {
            abort(403, 'Unauthorized action.');
        }

        try{
            DB::beginTransaction();
            $user = User::where('id',$request->id)->first();
            if($user->is_blocked == 1){
                $user->is_blocked=0;
            }else{
                $user->is_blocked=1;

            }
            $user->save();

            DB::commit();
            return response()->json(['success'=>'User Blocked successfully']);

        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['error'=>'Something Wrong']);

        }
    }



    public function search(Request $request){


        $users=User::where('name','LIKE','%'.$request->table_search.'%')->get();
        $links = true;
        return view('admin.users.index',compact('users','links'));
    }
}
