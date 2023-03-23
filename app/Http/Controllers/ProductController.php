<?php

namespace App\Http\Controllers;

use  Illuminate\Http\Request;
use  App\Models\Product;
use  App\Models\Barang_Alias;
use  App\Models\Barang_jenis;
use  App\Models\Barang_Varian;

use App\Models\GroupToko;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('logincek');
    }

    //product
    public function product(){

        $product = Product::all();
        $variasi = Barang_Varian::all();
        // $var = Barang_Varian::where('id', $variasi['id'])->first();
        // dd($var);
        return view('dashboard.product.index-product', compact('product','variasi'));
    }

    public function create_product(){
        $jenis_barang = Barang_jenis::all();
        return view('dashboard.product.create-product', compact('jenis_barang'));
    }


    public function CreateProduct(Request $request){
        // dd($request);
        $user = Auth()->user()->id;

        $request->validate([
            'kode' => 'required',
            'nama_barang' => 'required',
            'fid_jenis_barang' => 'required',
        ]);

        $barang = new Product();
        $barang->kode = $request->kode;
        $barang->nama_barang = $request->nama_barang;
        $barang->fid_jenis_barang = $request->fid_jenis_barang;
        $barang->produk_sendiri = true;
        $barang->created_by = $user;
        $barang->updated_by= $user;

        // dd($barang);

        if($barang->save()){
            return redirect()->route('product')->with('Success', 'Berhasil menambahkan data baru');
        }else{
            return redirect()->back()->with('Faild', 'Gagal menambahkan data barang');
        }
    }

    public function edit_product($id){
        $dec = decrypt($id);
        $barang = Product::findOrFail($dec);
        $jenis_barang = Barang_jenis::all();
        return view('dashboard.product.edit-product', compact('jenis_barang', 'barang'));
    }

    public function UpdateProduct(Request $request, $id){

        $user = Auth()->user()->id;

        $request->validate([
            'kode' => 'required',
            'nama_barang' => 'required',
            'fid_jenis_barang' => 'required',
        ]);

        $dec = decrypt($id);
        $barang = Product::findOrFail($dec);
        $barang->kode = $request->kode;
        $barang->nama_barang = $request->nama_barang;
        $barang->fid_jenis_barang = $request->fid_jenis_barang;
        $barang->produk_sendiri = true;
        $barang->created_by = $user;
        $barang->updated_by= $user;
        // dd($barang);

        if($barang->save()){
            return redirect()->route('product')->with('Success', 'Berhasil menambahkan data baru');
        }else{
            return redirect()->back()->with('Faild', 'Gagal menambahkan data barang');
        }
    }

    public function DeleteProduct($id){
        $product = Product::where('id', $id)->first();
        $product->delete();

        return redirect()->back()->with('Success', 'Data Berhasil di hapus');
    }




    //Variasi Barang

    public function update_Varian(Request $request){
        $user = Auth()->user()->id;

        if($request->id){
            $Varian_barang = Barang_Varian::where('id', $request->id)->first();
        }else{
            $Varian_barang = new Barang_Varian();
        }

        $Varian_barang -> fid_barang = $request->fid_barang;
        $Varian_barang -> nama_varian = $request->nama_varian ;
        $Varian_barang -> created_by = $user;
        $Varian_barang -> updated_by = $user;

        // dd($Varian_barang);

        $Varian_barang->save();
        return response()->json(['success' => 1, 'message' => 'varian Berhasil Diupdate']);
    }

    public function edit_varian(Request $request){
        $Varian_barang = Barang_Varian::where('id', $request->id)->first();
        $barang = Product::where('id', $Varian_barang->fid_barang)->first();
        return response()->json(['success' => 1, 'message' => 'Role Berhasil Diambil', 'data' => $Varian_barang, 'barang' =>$barang]);
    }

    public function DeleteVarian($id){

        $Varian_barang = Barang_Varian::where('id', $id)->first();
        $Varian_barang->delete();

        return redirect()->back();

    }


    // alias barang
    public function aliasProduct(){

        $alias = Barang_Alias::all();
        $product = Product::all();
        $jenis_barang = Barang_jenis::all();
        $group = GroupToko::all();
        return view('dashboard.product.aliasProduct', compact('alias', 'product','jenis_barang','group'));
    }


    public function update_data_alias(Request $request){
        $user = Auth()->user()->id;

        if($request->id){
            $alias_barang = Barang_Alias::where('id', $request->id)->first();
        }else{
            $alias_barang = new Barang_Alias();
        }

        $alias_barang -> fid_barang = $request->fid_barang;
        $alias_barang -> fid_group = $request->fid_group;
        $alias_barang -> alias = $request->alias;
        $alias_barang -> created_by = $user;
        $alias_barang -> updated_by = $user;

        // dd($alias_barang);

        $alias_barang->save();
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

        $alias_barang = Barang_Alias::where('id', $id)->first();
        $alias_barang->delete();

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
