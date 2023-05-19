<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\ContactPersonSupplier;
use App\Models\User_Log;
class SuplierController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('logincek');
    }


    public function supplier(){

        $suplier = Supplier::all();
        $detail_contact = ContactPersonSupplier::all();
        return view('dashboard.Supplier.index-supplier', compact('suplier', 'detail_contact'));
    }
    public function create_supplier(){
        return view('dashboard.Supplier.create-supplier');
    }


    public function post_suplier(Request $request){
        // dd($request);
        $admin = Auth()->user()->id;
        $activity = new User_Log();
        $activity->fid_user =  $admin ;
        $activity->log = "Menambahkan data Supplier ";

        $request->validate([
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'npwp' => 'required',
            'email' => 'required',
            'no_hp'=> 'required',

        ]);

        $suplier = new Supplier();
        $suplier->nama_supplier = $request->nama_supplier;
        $suplier->alamat = $request->alamat;
        $suplier->npwp = $request->npwp;
        $suplier->email = $request->email;
        $suplier->no_hp = $request->no_hp;
        $suplier->created_by = $admin;
        $suplier->updated_by = $admin;
        // dd($suplier);
        // $suplier->save();
        if($suplier->save()){
            $activity->save();
            return redirect()->route('supplier')->with('success','data Supplier berhasil di tambahkan ');
        }else{
            return redirect()->back()->with('error','data Supplier gagal di tambahkan ');
        }
    }

    public function edit_supplier($id){
        $dec = decrypt($id);
        $sp = Supplier::findOrFail( $dec );
        return view('dashboard.Supplier.edit-supplier', compact('sp'));
    }

    public function updateSuplier(Request $request, $id){

        $admin= Auth()->user()->id;

        $activity = new User_Log();
        $activity->fid_user =  $admin ;
        $activity->log = "Mengubah data Supplier";

        $request->validate([
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'npwp' => 'required',
            'email' => 'required',
            'no_hp'=> 'required',
        ]);

        $dec = decrypt($id);
        $suplier = Supplier::findOrFail( $dec );
        $suplier->nama_supplier = $request->nama_supplier;
        $suplier->alamat = $request->alamat;
        $suplier->npwp = $request->npwp;
        $suplier->email = $request->email;
        $suplier->no_hp = $request->no_hp;
        $suplier->created_by = $admin;
        $suplier->updated_by = $admin;

        if($suplier->save()){
            $activity->save();
            return redirect()->route('supplier')->with('success','data Supplier berhasil di tambahkan ');
        }else{
            return redirect()->back()->with('error','data Supplier gagal di tambahkan ');
        }
    }

    public function delete_data_sp($id){
        $suplier = Supplier::where('id', $id)->first();
        $suplier -> delete();
        return redirect()->back();
    }


    // detail contact supplier

    public function update_dataContact(Request $request){
        // dd($request);
        $admin= Auth()->user()->id;

        if($request->id){
            $suplierContact = ContactPersonSupplier::where('id', $request->id)->first();
            $activity = new User_Log();
            $activity->fid_user =  $admin ;
            $activity->log = "Mengubah data Detail Supplier";
        }else{
            $activity = new User_Log();
            $activity->fid_user =  $admin ;
            $activity->log = "Menambahkan data Detail Supplier";

            $suplierContact = new ContactPersonSupplier();
        }
         $suplierContact->fid_supplier = $request->fid_supplier;
         $suplierContact->nama_lengkap = $request->nama_lengkap;
         $suplierContact->jabatan = $request->jabatan;
         $suplierContact->departemen = $request->departemen;
         $suplierContact->email = $request->email;
         $suplierContact->no_hp = $request->no_hp;
         $suplierContact->created_by = $admin;
         $suplierContact->updated_by = $admin;

        //  dd($suplierContact);
         $suplierContact->save();
         $activity->save();
        return response()->json([
            'success' => 1,
            'message' => 'jeis barang Berhasil Diupdate',
        ]);
    }

    public function edit_contactSupplier(Request $request){
        $contact = ContactPersonSupplier::where('id', $request->id)->first();
        // dd($contact);
        $suplier = Supplier::where('id', $contact->fid_supplier)->first();

        return response()->json([
            'success' => 1,
            'message' => 'Role Berhasil Diambil',
            'data' =>  $contact,
            'supplier' => $suplier,
        ]);
    }

    public function delete_data_contact($id){
        $admin= Auth()->user()->id;

        $activity = new User_Log();
        $activity->fid_user =  $admin ;
        $activity->log = "Menghapus data Supplier";

        $contact = ContactPersonSupplier::where('id', $id)->first();
        $contact -> delete();
        $activity->save();
        return redirect()->back();
    }
}
