<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupMember;
use App\Models\GroupToko;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GroupController extends Controller
{
    //
    public function dataGroup(Request $request){
        $group = GroupToko::all();
        // $grp = GroupToko::where('id', $request->id)->first();
        return view('dashboard.Group.data_group', compact('group'));
    }

    public function CreateGroup(){
        return view('dashboard.Group.create_group');
    }
    public function EditGroup($id){
        $dec = decrypt($id);
        $grp = GroupToko::findOrFail( $dec );
        return view('dashboard.Group.edit_group_data', compact('dec', 'grp'));
    }

    public function postDataGroup(Request $request){
        $admin= Auth()->user()->id;

        $request->validate([
            'nama_toko' => 'required',
            'kode_invoice' => 'required',
            'alamat' => 'required',
            'rekening_no_ppn' => 'required',
            'rekening_ppn' => 'required',
            'no_telpon' => 'required|numeric',
            'logo_toko' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'shoppee_hook' => 'required',
            'tokopedia_hook' => 'required',
        ]);

        $dt_Gp = new GroupToko();
        $dt_Gp->nama_toko = $request->nama_toko;
        $dt_Gp->kode_invoice = $request->kode_invoice;
        $dt_Gp->alamat = $request->alamat;
        $dt_Gp->rekening_no_ppn = $request->rekening_no_ppn;
        $dt_Gp->rekening_ppn = $request->rekening_ppn;
        $dt_Gp->no_telpon = $request->no_telpon;
        $dt_Gp->shoppee_hook = $request->shoppee_hook;
        $dt_Gp->tokopedia_hook = $request->tokopedia_hook;
        $dt_Gp->created_by = $admin ;
        $dt_Gp->updated_by = $admin ;

        if($file = $request->hasFile('logo_toko')){

            $file =$request->file('logo_toko');

            $fileName = $file->getClientOriginalName();

            $destination = public_path().'/Assets/image/Logo/';



            if(!file_exists($destination)){

                mkdir($destination, 0777, true);

            }



            $file->move($destination, $fileName);

            $dt_Gp->logo_toko = 'http://localhost:8000/Assets/image/Logo/'.$fileName;
        }

        // dd($dt_Gp);
        if($dt_Gp->save()){
            return redirect()->route('dataGroup')->with('Success', 'Berhasil menambahkan data baru');
        }else{
            return redirect()->back()->with('Faild', 'Gagal menambahkan data baru');
        }
    }

    public function updateData(Request $request,$id){

        $admin= Auth()->user()->id;

        $request->validate([
            'nama_toko' => 'required',
            'kode_invoice' => 'required',
            'alamat' => 'required',
            'rekening_no_ppn' => 'required',
            'rekening_ppn' => 'required',
            'no_telpon' => 'required|numeric',
            'logo_toko' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'shoppee_hook' => 'required',
            'tokopedia_hook' => 'required',
        ]);
        $dec = decrypt($id);
        $dt_Gp = GroupToko::findOrFail($dec);
        $dt_Gp->nama_toko = $request->nama_toko;
        $dt_Gp->kode_invoice = $request->kode_invoice;
        $dt_Gp->alamat = $request->alamat;
        $dt_Gp->rekening_no_ppn = $request->rekening_no_ppn;
        $dt_Gp->rekening_ppn = $request->rekening_ppn;
        $dt_Gp->no_telpon = $request->no_telpon;
        $dt_Gp->shoppee_hook = $request->shoppee_hook;
        $dt_Gp->tokopedia_hook = $request->tokopedia_hook;
        $dt_Gp->created_by = $admin ;
        $dt_Gp->updated_by = $admin ;


        if($file = $request->hasFile('logo_toko')){

            $file =$request->file('logo_toko');

            $fileName = $file->getClientOriginalName();

            $destination = public_path().'/Assets/image/Logo/';



            if(!file_exists($destination)){

                mkdir($destination, 0777, true);

            }



            $file->move($destination, $fileName);

            $dt_Gp->logo_toko = 'http://localhost:8000/Assets/image/Logo/'.$fileName;
        }

        // dd($dt_Gp);

        if($dt_Gp->save()){
            return redirect()->route('dataGroup')->with('Success', 'Berhasil menambahkan data baru');
        }else{
            return redirect()->back()->with('Faild', 'Gagal menambahkan data baru');
        }
    }

    public function DeleteData($id){
        $admin= Auth()->user()->id;

        $toko = GroupToko::where('id', $id)->first();

        $toko->delete();

        return redirect()->back();

    }

    public function dataGroupMember(){

        $member = GroupMember::all();

        return view('dashboard.Group.data_group_member',compact('member'));
    }

    public function CreateGroupMember(){
        $user = User::all();
        $group = GroupToko::all();
        return view('dashboard.Group.create_group_member', compact('user','group'));
    }

    public function create_member(Request $request){
        $admin = Auth()->user()->id;

        $request->validate([
            'fid_user'  => 'required',
            'fid_group' => 'required',
        ]);

        $member = new GroupMember();
        $member->fid_user = $request->fid_user;
        $member->fid_group = $request->fid_group;
        $member->created_by = $admin ;
        $member->updated_by = $admin ;

        if($member->save()){
            return redirect()->route('dataGroupMember')->with('Success', 'Berhasil menambahkan data baru');

        }else{
            return redirect()->back()->with('Faild', 'Gagal Menabahkan data baru');
        }
    }


    public function EditGroupMember($id){
        $dec = decrypt($id);
        $gm = GroupMember::findOrFail( $dec );
        $user = User::all();
        $group = GroupToko::all();
        return view('dashboard.Group.edit_member_group', compact('gm','user','group'));
    }
    public function edit_member(Request $request, $id){
        $admin = Auth()->user()->id;

        $request->validate([
            'fid_user'  => 'required',
            'fid_group' => 'required',
        ]);

        $dec = decrypt($id);
        $member = GroupMember::findOrFail( $dec );
        $member->fid_user = $request->fid_user;
        $member->fid_group = $request->fid_group;
        $member->created_by = $admin ;
        $member->updated_by = $admin ;

        if($member->save()){
            return redirect()->route('dataGroupMember')->with('Success', 'Berhasil menambahkan data baru');

        }else{
            return redirect()->back()->with('Faild', 'Gagal Menabahkan data baru');
        }
    }

    public function DeleteDataMember($id){
        $admin= Auth()->user()->id;
        if($admin){
            $member = GroupMember::where('fid_user',$admin)->first();

        }
        $member = GroupMember::where('id', $id)->first();
        $member->delete();

        return redirect()->back();

    }

}
