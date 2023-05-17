<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_Role;
use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('logincek');
    }

    public function dataUser(){
        $user = User::all();
        $edit_user = User::first();
        $user_role = User_Role::all();
        return view('dashboard.Acount.data_acount_admin', compact('user', 'user_role','edit_user'));
    }
    public function dataRole(){
        $role = User_Role::all();
        return view('dashboard.Acount.data_role_admin', compact('role'));
    }

    public function createRole(){
        return view('dashboard.Acount.create_role');
    }

    public function postData(Request $request){
         $user = Auth()->user()->id;
        $role = User_Role::get();
        if($request->id){
            $role_update = User_Role::where('id', $request->id)->first();
        }else{
            $role_update =new User_Role();
        }

         $role_update->nama_role = $request->nama_role;
         $role_update->level = $request->level;
         $role_update->created_by = $user;
         $role_update->updated_by = $user;
        //  dd($role_update);
         $role_update->save();
         return response()->json(['success' => 1, 'message' => 'role Berhasil Diupdate']);



    }

    public function editRole(Request $request){
        $role_update = User_Role::where('id', $request->id)->first();
        return response()->json(['success' => 1, 'message' => 'Role Berhasil Diambil', 'data' => $role_update]);
    }

    public function DeleteData($id){

        $role = User_Role::where('id', $id)->first();
        $role->delete();

        return redirect()->back();

    }
}
