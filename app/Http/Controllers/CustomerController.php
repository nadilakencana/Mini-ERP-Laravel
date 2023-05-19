<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\ContactPersonCustomer;
use App\Models\User_Log;
class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincek');
    }
    public function customer(){
        $customer = Customer::all();
        $detailContact = ContactPersonCustomer::all();
        // dd($detailContact->customers->nama_customer);
        return view('dashboard.customer.index_customer', compact('customer','detailContact'));
    }


    public function create_customer(){
        $customer = Customer::all();
        return view('dashboard.customer.create_customer', compact('customer'));
    }
    public function CreateCustomer(Request $request){
        $admin = Auth()->user()->id;
        $activity = new User_Log();


        $activity->fid_user = $admin;
        $activity->log = "Menambahkan data Customer".$request->log;

        $request->validate([
            'nama_customer' => 'required' ,
            'alamat'  => 'required',
            'npwp'  => 'required',
            'email'  => 'required',
            'no_hp'  => 'required',

        ]);

        $customer = new Customer();
        $customer->nama_customer = $request->nama_customer;
        $customer->alamat = $request->alamat;
        $customer->npwp = $request->npwp;
        $customer->email = $request->email;
        $customer->no_hp = $request->no_hp;
        $customer->created_by =  $admin;
        $customer->updated_by =  $admin;

        // dd($customer);
        if($customer->save()){
            $activity->save();
            return redirect()->route('customer')->with('success','data Customer berhasil di tambahkan ');
        }else{
            return redirect()->back()->with('error','data Customer gagal di tambahkan ');
        }
    }

    public function CreateCustomerInSales(Request $request){
        $admin = Auth()->user()->id;
        $activity = new User_Log();


        $activity->fid_user = $admin;
        $activity->log = "Menambahkan data Customer".$request->log;

        $customer = new Customer();
        $customer->nama_customer = $request->nama_customer;
        $customer->alamat = $request->alamat;
        $customer->npwp = $request->npwp;
        $customer->email = $request->email;
        $customer->no_hp = $request->no_hp;
        $customer->created_by =  $admin;
        $customer->updated_by =  $admin;

        // dd($customer);
        $customer->save();
        $activity->save();
        return response()->json([
            'success' => 1,
            'message' => 'jeis barang Berhasil Diupdate',
        ]);
    }


    public function edit_customer($id){
        $dec = decrypt($id);
        $customer = Customer::findOrFail( $dec );
        return view ('dashboard.customer.edit_customer', compact('customer'));
    }

    public function EditCustomer(Request $request, $id){
        $admin = Auth()->user()->id;
        $activity = new User_Log();


        $activity->fid_user = $admin;
        $activity->log = "Mengedit data Customer".$request->log;

        $request->validate([
            'nama_customer' => 'required' ,
            'alamat'  => 'required',
            'npwp'  => 'required',
            'email'  => 'required',
            'no_hp'  => 'required',

        ]);

        $dec = decrypt($id);
        $customer = Customer::findOrFail($dec);
        $customer->nama_customer = $request->nama_customer;
        $customer->alamat = $request->alamat;
        $customer->npwp = $request->npwp;
        $customer->email = $request->email;
        $customer->no_hp = $request->no_hp;
        $customer->created_by =  $admin;
        $customer->updated_by =  $admin;

        // dd($customer);
        if($customer->save()){
            $activity->save();
            return redirect()->route('customer')->with('success','data Customer berhasil di edit ');
        }else{
            return redirect()->back()->with('error','data Customer gagal di edit ');
        }
    }

    public function delete_data_customer($id){
        $customer = Customer::where('id', $id)->first();
        $admin = Auth()->user()->id;
        $activity = new User_Log();


        $activity->fid_user = $admin;
        $activity->log = "menghapus data Customer";

        $customer -> delete();
        $activity->save();
        
        return redirect()->back();
    }


    // data detail contact Customer

    public function updateContactDetail(Request $request){
        $admin= Auth()->user()->id;

        if($request->id){
            $ContactCustomer = ContactPersonCustomer::where('id', $request->id)->first();
        }else{
            $ContactCustomer = new ContactPersonCustomer();
        }
         $ContactCustomer->fid_customer = $request->fid_customer;
         $ContactCustomer->nama_lengkap = $request->nama_lengkap;
         $ContactCustomer->jabatan = $request->jabatan;
         $ContactCustomer->departemen = $request->departemen;
         $ContactCustomer->email = $request->email;
         $ContactCustomer->no_hp = $request->no_hp;
         $ContactCustomer->created_by = $admin;
         $ContactCustomer->updated_by = $admin;

        //  dd($suplierContact);
         $ContactCustomer->save();
        return response()->json([
            'success' => 1,
            'message' => 'jeis barang Berhasil Diupdate',
        ]);
    }

    public function edit_contactCustomer(Request $request){
        $contactCustomer = ContactPersonCustomer::where('id', $request->id)->first();
        // dd($contact);
        $Customer = Customer::where('id', $contactCustomer->fid_customer)->first();

        return response()->json([
            'success' => 1,
            'message' => 'Role Berhasil Diambil',
            'data' =>  $contactCustomer,
            'customer' => $Customer,
        ]);
    }

    public function delete_customer_contact($id){
        $contactCustomer = ContactPersonCustomer::where('id', $id)->first();
        $contactCustomer -> delete();
        return redirect()->back();
    }
}
