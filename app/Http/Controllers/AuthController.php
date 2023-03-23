<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function viewLogin(){
        return view('auth.Login');
    }
    public function viewRegist(){
        return view('auth.Registrasi');
    }

    public function postLogin(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],

        ]);

        // dd($credentials);
        if(Auth::attempt($credentials)){

            if(Auth::check() && Auth::user()->role == 3){
            //     $user = Auth::user();
            //     $user = ['status'=> 1];

            //    Auth::update($user);

                return redirect()->intended('Dashboard');
            }
            // } else {
            //     return redirect()->route('profile.show', encrypt(Auth()->user()->id));
            // }
            $request->session()->regenerate();

        }else{
            return back()->with('error','Login Failed!');
        }

    }


    public function Regist(Request $request){
        $request->validate([
            'nama'=> ['required'],
            'email' => ['required','unique:user'],
            'password' => ['required','min:6'],
            'no_hp' => ['required','numeric'],
        ]);

        $data = [
            'username'=> $request->nama,
            'nama'=> $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'no_hp' => $request->no_hp,
            'role' => 3,
        ];
        // dd($data);

        // dd($User);
        if(User::create($data)){
            return redirect('/')->with('Success', 'Registration Admin Successfull !');

        }else{
            return back()->with('Error', 'Registration Admin faild !');
        }


    }

    public function Logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function updateAdmin(Request $request,$id){
        $dec = decrypt($id);
        $edit_user = User::findOrFail( $dec );

        $edit_user->username = $request->username;
        $edit_user->nama = $request->nama;
        // $edit_user->password = bcrypt($request->password);
        $edit_user->email = $request->email;
        $edit_user->no_hp = $request->no_hp;
        $edit_user->role = $request->role;
        // dd( $edit_user);
        $edit_user->save();
        return redirect()->route('dataUser');
    }

}
