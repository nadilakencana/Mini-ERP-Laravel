<?php

namespace App\Http\Controllers;

use  Illuminate\Http\Request;
use  App\Models\Product;
use  App\Models\Barang_Alias;
use  App\Models\Barang_jenis;
use  App\Models\Barang_Varian;
use App\Models\GroupMember;
use App\Models\GroupToko;
use Illuminate\Support\Carbon;
use App\Models\User_Log;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('logincek');
    }

    //product
    public function product(){

        $product = Product::where('approved', '1')->get();
        $product_not_approved = Product::where('approved','0')->get();
        $variasi = Barang_Varian::all();
        $jenis_barang = Barang_jenis::all();
        // $var = Barang_Varian::where('id', $variasi['id'])->first();
        // dd($var);
        return view('dashboard.product.index-product', compact('product','variasi','jenis_barang','product_not_approved'));
    }

    public function create_product(){
        $jenis_barang = Barang_jenis::all();
        return view('dashboard.product.create-product', compact('jenis_barang'));
    }


    public function CreateProduct(Request $request){
        // dd($request);
        $user = Auth()->user()->id;
        $activity = new User_Log();
        $activity->fid_user = $user;
        $activity->log = "Menambahkan data Master Barang ".$request->log;

        $request->validate([
            'kode' => 'required',
            'nama_barang' => 'required',
            'fid_jenis_barang' => 'required',
            'harga' => 'required',
        ]);

        $barang = new Product();
        $barang->kode = $request->kode;
        $barang->nama_barang = $request->nama_barang;
        $barang->fid_jenis_barang = $request->fid_jenis_barang;
        $barang->harga = $request->harga;
        $barang->produk_sendiri = $request->produk_sendiri;
        $barang->approved = false;
        $barang->created_by = $user;
        $barang->updated_by= $user;

        // dd($barang);

        if($barang->save()){
            $activity->save();
            return redirect()->route('product')->with('Success', 'Berhasil menambahkan data baru');
        }else{
            return redirect()->back()->with('Faild', 'Gagal menambahkan data barang');
        }
    }

    public function CreateProductInSales(Request $request){
        // dd($request);
        $user = Auth()->user()->id;
        $activity = new User_Log();

        $activity->fid_user = $user;
        $activity->log = "Menambahkan data Product".$request->log;

        $barang = new Product();
        $barang->kode = $request->kode;
        $barang->nama_barang = $request->nama_barang;
        $barang->fid_jenis_barang = $request->fid_jenis_barang;
        $barang->harga = $request->harga;
        $barang->produk_sendiri = $request->produk_sendiri;
        $barang->approved = false;
        $barang->created_by = $user;
        $barang->updated_by= $user;

        // dd($barang);
        $barang->save();
        $activity->save();
        return response()->json([
            'success'=> 1,
            'data' => $barang,
            'message' => 'data berhasil di tambahkan'
        ]);
    }

    public function approvedProduct(Request $request,$id){
        $user = Auth()->user()->id;

        $activity = new User_Log();
        $activity->fid_user = $user;
        $activity->log = "Melakukan Approval Master Barang".$request->log;

        $product = Product::find($id);
        $product->approved = true;
        $product->user_approved = $user;
        $product->tanggal_approved = Carbon::now()->toDateTimeString();

        $product->save();
        $activity->save();
        return response()->json(['success' => 1, 'data' => $product]);
    }

    public function edit_product($id){
        $dec = decrypt($id);
        $barang = Product::findOrFail($dec);
        $jenis_barang = Barang_jenis::all();
        return view('dashboard.product.edit-product', compact('jenis_barang', 'barang'));
    }

    public function UpdateProduct(Request $request, $id){

        $user = Auth()->user()->id;

        $activity = new User_Log();
        $activity->fid_user = $user;
        $activity->log = "Mengubah data Master Barang".$request->log;

        $request->validate([
            'kode' => 'required',
            'nama_barang' => 'required',
            'fid_jenis_barang' => 'required',
            'harga' => 'required',

        ]);

        $dec = decrypt($id);
        $barang = Product::findOrFail($dec);
        $barang->kode = $request->kode;
        $barang->nama_barang = $request->nama_barang;
        $barang->fid_jenis_barang = $request->fid_jenis_barang;
        $barang->harga = $request->harga;
        $barang->produk_sendiri = true;
        $barang->created_by = $user;
        $barang->updated_by= $user;
        // dd($barang);

        if($barang->save()){
            $activity->save();
            return redirect()->route('product')->with('Berhasil', 'mengubah data');
        }else{
             return redirect()->back()->with('Faild', 'Gagal menambahkan data barang');
        }
    }

    public function DeleteProduct($id){
        $product = Product::where('id', $id)->first();
        $user = Auth()->user()->id;
        $activity = new User_Log();


        $activity->fid_user = $user;
        $activity->log = "Menghapus data master Product";

        $product->delete();
        $activity->save();

        return redirect()->back()->with('Success', 'Data Berhasil di hapus');
    }

    //Variasi Barang

    public function newVarian(Request $request){
        $user = Auth()->user()->id;

        $activity = new User_Log();

        $activity->fid_user = $user;
        $activity->log = "Menambahkan Data varian Barang";

        $varians = $request->varian;
        // dd($varians);
        foreach($varians as $varian){
            // dd($varian);
            $brangVarian = New Barang_Varian();
            $brangVarian-> fid_jenis_barang  =  $varian['fid_jenis_barang'];
            $brangVarian-> nama_varian = $varian['nama_varian'];
            $brangVarian-> created_by  = $user;
            $brangVarian-> updated_by  = $user;

            // dd($brangVarian);
            $brangVarian->save();
        }

        $activity->save();
        return redirect()->back()->with('Success', 'Berhasil menambahkan Varian');

    }

    public function update_Varian(Request $request){

        $user = Auth()->user()->id;
        $activity = new User_Log();

        $activity->fid_user = $user;
        $activity->log = "Menambahkan Data varian Barang";

        if($request->id){
            $Varian_barang = Barang_Varian::where('id', $request->id)->first();
            $activity = new User_Log();

            $activity->fid_user = $user;
            $activity->log = "Mengubah Data varian Barang";
        }else{
            $activity = new User_Log();

            $activity->fid_user = $user;
            $activity->log = "Menambahkan Data varian Barang";

            $Varian_barang = new Barang_Varian();

        }

        $Varian_barang -> fid_jenis_barang = $request->fid_jenis_barang;
        $Varian_barang -> nama_varian = $request->nama_varian ;
        $Varian_barang -> created_by = $user;
        $Varian_barang -> updated_by = $user;

        // dd($Varian_barang);

        $Varian_barang->save();
        $activity->save();
        return response()->json(['success' => 1, 'message' => 'varian Berhasil Diupdate']);
    }

    public function edit_varian(Request $request){
        $Varian_barang = Barang_Varian::where('id', $request->id)->first();
        $barang_jenis = Barang_jenis::where('id', $Varian_barang->fid_jenis_barang)->first();
        return response()->json(['success' => 1, 'message' => 'Varian Berhasil Diambil', 'data' => $Varian_barang, 'barangJenis' =>$barang_jenis]);
    }

    public function DeleteVarian($id){
        $user = Auth()->user()->id;
        $activity = new User_Log();

        $activity->fid_user = $user;
        $activity->log = "Menghapus Data varian Barang";

        $Varian_barang = Barang_Varian::where('id', $id)->first();

        $Varian_barang->delete();
        $activity->save();
        return redirect()->back();

    }


    // alias barang
    public function aliasProduct(){

        $admin = Auth()->user()->id;
        $memberToko = GroupMember::where('fid_user', $admin)->first();
        $alias = Barang_Alias::where('fid_group', $memberToko->id)->get();
        $product = Product::where('approved',1)->get();
        $jenis_barang = Barang_jenis::all();
        $group = GroupToko::all();
        return view('dashboard.product.aliasProduct', compact('alias', 'product','jenis_barang','group'));
    }

    public function getMasterBarang(){
        return Product::where('approved','1')->get()->pluck('id','nama_barang');
    }

    public function update_data_alias(Request $request){
        $user = Auth()->user()->id;

        if($request->id){
            $activity = new User_Log();

            $activity->fid_user = $user;
            $activity->log = "Mengubah Data alias Barang";
            $alias_barang = Barang_Alias::where('id', $request->id)->first();
        }else{
            $activity = new User_Log();

            $activity->fid_user = $user;
            $activity->log = "Menambahkan Data Alias Barang";

            $alias_barang = new Barang_Alias();
        }

        $alias_barang -> fid_barang = $request->fid_barang;
        $alias_barang -> fid_group = $request->fid_group;
        $alias_barang -> alias = $request->alias;
        $alias_barang -> harga = $request->harga;
        $alias_barang -> created_by = $user;
        $alias_barang -> updated_by = $user;

        // dd($alias_barang);

        $alias_barang->save();
        $activity->save();
        return response()->json(['success' => 1, 'message' => 'jenis barang Berhasil Diupdate']);
    }

    public function edit_alias(Request $request){
        $alias_barang = Barang_Alias::where('id', $request->id)->first();
        $barang  =  Product::where('id', $alias_barang->fid_barang)->first();
        $group = GroupToko::where('id',  $alias_barang->fid_group)->first();
        return response()->json([
            'success' => 1,
            'message' => 'Role Berhasil Diambil',
            'data' =>  $alias_barang,
            'barang' => $barang,
            'group'=>$group
        ]);
    }

    public function DeleteAlias($id){
        $user = Auth()->user()->id;
        $activity = new User_Log();

        $activity->fid_user = $user;
        $activity->log = "Menghapus Data Alias Barang";

        $alias_barang = Barang_Alias::where('id', $id)->first();

        $alias_barang->delete();
        $activity->save();
        return redirect()->back();

    }

    // jenis barang
    public function jenisProduct(){
        $jenis_barang = Barang_jenis::all();
        $product = Product::all();
        $group = GroupToko::all();
        return view('dashboard.product.jenisProduct', compact('jenis_barang','product','group'));
    }

    public function dataPost(Request $request){
        $user = Auth()->user()->id;

        if($request->id){
            $jenis_barang = Barang_jenis::where('id', $request->id)->first();
        }else{
            $jenis_barang = new Barang_jenis();
        }

        $jenis_barang -> nama_jenis = $request->nama_jenis;
        $jenis_barang -> created_by = $user;
        $jenis_barang -> updated_by = $user;

        $jenis_barang->save();
        return response()->json(['success' => 1, 'message' => 'jeis barang Berhasil Diupdate']);
    }

    public function editdata(Request $request){
        $jenis_update = Barang_jenis::where('id', $request->id)->first();
        return response()->json(['success' => 1, 'message' => 'Role Berhasil Diambil', 'data' => $jenis_update]);
    }

    public function DeleteJenis($id){

        $jenis_barang = Barang_jenis::where('id', $id)->first();
        $jenis_barang->delete();

        return redirect()->back();

    }




}
