<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Pembelian;
use App\Models\DetailPembelian;
use App\Models\Barang_Alias;
use App\Models\Barang_jenis;
use App\Models\Barang_Varian;
use App\Models\DetailPembayaranPembelian;
use App\Models\GroupToko;
use App\Models\GroupMember;
use App\Models\Supplier;
use Illuminate\Support\Carbon;
use App\Models\ContactPersonSupplier;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\User_Log;
use App\Models\User;
class PembelianController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('logincek');
    }


    public function pembelian(){
        $admin = Auth()->user()->id;
        $user = User::where('id', $admin)->with('role_admin')->whereHas('role_admin', function ($query) {
            $query->where('nama_role', 'Marketing');
        })
        ->first();

        $memberToko = GroupMember::where('fid_user', $admin)->first();
        if($user){

            $Pembelian = Pembelian::where('fid_group', $memberToko->fid_group)->where('approval', '1')->where('batal', '0')->orderBy('updated_at', 'desc')->paginate(10);
            $POCencel = Pembelian::where('fid_group', $memberToko->fid_group)->where('batal', '1')->where('approval', '1')->orderBy('updated_at', 'desc')->paginate(10);
            $aprovPO = pembelian::where('fid_group', $memberToko->fid_group)->where('approval', '0')->orderBy('updated_at', 'desc')->paginate(10);
        }else{
            $Pembelian = Pembelian::where('approval', '1')->where('batal', '0')->orderBy('updated_at', 'desc')->paginate(10);
            $aprovPO = Pembelian::where('approval', '0')->orderBy('updated_at', 'desc')->paginate(10);
            $POCencel = Pembelian::where('batal', '1')->where('approval', '1')->orderBy('updated_at', 'desc')->paginate(10);
        }
        return view('dashboard.purchase.pembelian', compact('Pembelian', 'aprovPO', 'POCencel'));
    }

    public function getLoadData(){
        $admin = Auth()->user()->id;
        $memberToko = GroupMember::where('fid_user', $admin)->first();
        $Pembelian = Pembelian::where('fid_group', $memberToko->fid_group)->orderBy('updated_at', 'desc')->paginate(2);

        return view('dashboard.part-lain.data-pembelian', compact('Pembelian'));
    }

    public function getDetailPenjualan(Request $request){
        $refSales = $request->refId;
        // dd($refSales);
        $Penjualan = Penjualan::where('id', $refSales)->first();
        $DetailPenjualan = DetailPenjualan::where('fid_penjualan', $Penjualan->id)->get();
        // dd(count($DetailPenjualan));

        foreach($DetailPenjualan as $k => $DetailPenjualan){
            $k < count($DetailPenjualan->toArray()) - 1;


		}


        return view('dashboard.part-lain.detail_penjualan', compact('Penjualan', 'DetailPenjualan'));

    }
    public function getDetailPenjualanRefPO(Request $request){
        $refSales = $request->refId;
        // dd($refSales);
        $Penjualan = Penjualan::where('id', $refSales)->first();
        $DetailPenjualan = DetailPenjualan::where('fid_penjualan', $Penjualan->id)->get();
        // dd(count($DetailPenjualan));

        return view('dashboard.part-lain.form_detail_penjulalan_refPO', compact('Penjualan', 'DetailPenjualan'));

    }

    public function create_purchase(){


        $admin = Auth()->user()->id;

        $memberToko = GroupMember::where('fid_user', $admin)->first();
        $supplier = Supplier::all();
        $product = Product::all();
        $group = GroupToko::all();
        $sales = Penjualan::all();
        $aliasProduct = Barang_Alias::where('fid_group',  $memberToko->fid_group)->get();
        $getRelation = $memberToko->group()->first();
        $kode = $getRelation->kode_invoice;
        $date = Carbon::now(); //->Format('y/m/d');
        $y = $date->format('y');
        $m = $date->format('m');
        $d = $date->format('d');

        $invoiceKode = 'PO/'.$kode.'/'.$y.'/'.$m.'/';

        $NoPO = Pembelian::where('no_faktur', 'LIKE', '%'.$invoiceKode.'%')->OrderBy('no_faktur','DESC')->first();
        // dd($lastFaktur);
        if( $NoPO){
            $lastFakturs =  $NoPO->no_faktur;
            $lastFakturs = explode('/', $lastFakturs);
            $lastFakturs = sprintf("%04d", intval($lastFakturs[count($lastFakturs)-1]) + 1);
            $PrefixFaktur = $invoiceKode.$d.'/'.$lastFakturs;
            // dd($PrefixFaktur);

        }else{
            $PrefixFaktur = $invoiceKode.$d.'/'.'0001';
        }

        $getInvoice = $PrefixFaktur;

        return view('dashboard.purchase.create_purchase', compact(
        'supplier',
        'product',
        'group',
        'aliasProduct',
        'getInvoice',
        'sales',
        ));
    }

    public function PostPemebelian(Request $request){
        $admin = Auth()->user()->id;
        $memberToko = GroupMember::where('fid_user', $admin)->first();

        $activity = new User_Log();
        $activity->fid_user = $admin;
        $activity->log = "Membuat Purchase Order".$request->log;

        $pembelian = new Pembelian();
        $pembelian->no_faktur = $request->faktur;
        $pembelian->fid_group = $memberToko->fid_group;
        $pembelian->fid_user = $admin;
        $pembelian->fid_supplier = $request->fid_supplier;
        $pembelian->tanggal = $request->tanggal;
        $pembelian->tanggal_kirim = $request->tanggal_kirim;
        $pembelian->alamat = $request->alamat;
        $pembelian->tunggu_konfirmasi_supplier = 0;
        $pembelian->keterangan = $request->keterangan;
        $pembelian->sub_total = $request->sub_total;
        $pembelian->diskon_nominal = $request->diskon_nominal;
        $pembelian->biaya_lain_lain = $request->biaya_lain_lain;
        $pembelian->ppn = $request->ppn;
        $pembelian->grand_total = $request->grand_total;
        $pembelian->created_by =  $admin;
        $pembelian->updated_by = $admin;
        $pembelian->status = 'Proses';
        $pembelian->batal = 0;
        $pembelian->approval = 1;
        $pembelian->fid_user_approval = $admin;
        $pembelian->alasan_pembatalan = 0;

        if($file = $request->hasFile('file_lembar_kerja')){

            $file =$request->file('file_lembar_kerja');

            $fileName = $file->getClientOriginalName();

            $destination = public_path().'/Assets/File_Kerja/';



            if(!file_exists($destination)){

                mkdir($destination, 0777, true);

            }



            $file->move($destination, $fileName);

            $pembelian->file_lembar_kerja = 'http://localhost:8000/Assets/File_Kerja/'.$fileName.$pembelian->id;
        }
        // dd($pembelian);
        if($pembelian->save()){
            $activity->save();

            if($request->has('productPembelian')){
                $product = $request->productPembelian;
                // dd($product);
                foreach($product as $productPembelian){
                    $alias = Barang_Alias::where('id',  $productPembelian['alias'])->first();
                    $barang = $alias->barang()->first();

                    $detailPembelian = new DetailPembelian();
                    $detailPembelian->fid_pembelian = $pembelian->id;
                    $detailPembelian->fid_jenis_barang = $barang->fid_jenis_barang;
                    $detailPembelian->fid_barang = $alias->id;
                    $detailPembelian->fid_varian = $productPembelian['variasi'];
                    $detailPembelian->jumlah = $productPembelian['jumlah'];
                    $detailPembelian->harga_satuan = $productPembelian['harga_satuan'];
                    $detailPembelian->total =  $productPembelian['total'];
                    $detailPembelian->keterangan =  $productPembelian['keterangan'];
                    $detailPembelian->created_by = $admin;
                    $detailPembelian->updated_by = $admin;
                    //  dd($detailPembelian);
                    $detailPembelian->save();
                }
            }






        return redirect()->route('purchase')->with('Success', 'Berhasil menambahkan data baru');

        }else{
            return redirect()->back()->with('Faild', 'Gagal Menabahkan data baru');
        }

    }

    public function EditPO($id){
        $admin = Auth()->user()->id;

        $dec = decrypt($id);
        $pembelian = Pembelian::findOrFail($dec);
        $detailPembelian = DetailPembelian::where('fid_pembelian', $pembelian->id)->get();
        // dd($detailPembelian['fid_jenis_barang']);
        // $variasi = Barang_Varian::where('id', $detailPembelian->fid_jenis_barang)->get();

        $memberToko = GroupMember::where('fid_user', $admin)->first();
        $supplier = Supplier::all();
        $product = Product::all();
        $group = GroupToko::all();
        $aliasProduct = Barang_Alias::where('fid_group',  $memberToko->fid_group)->get();
        $getRelation = $memberToko->group()->first();

        return view('dashboard.purchase.edit_purchase', compact(
            'pembelian',
            'detailPembelian',
            'memberToko',
            'supplier',
            'product',
            'group',
            'aliasProduct',
            'getRelation',
            // 'variasi'
        ));
    }

    public function PostEdit(Request $request, $id){
        $admin = Auth()->user()->id;

        $memberToko = GroupMember::where('fid_user', $admin)->first();

        $activity = new User_Log();
        $activity->fid_user = $admin;
        $activity->log = "Mengedit  Purchase Order".$request->log;

        $dec = decrypt($id);
        $pembelian = Pembelian::findOrFail($dec);
        $pembelian->no_faktur = $request->faktur;
        $pembelian->fid_group = $memberToko->fid_group;
        $pembelian->fid_user = $admin;
        $pembelian->fid_supplier = $request->fid_supplier;
        $pembelian->tanggal = $request->tanggal;
        $pembelian->tanggal_kirim = $request->tanggal_kirim;
        $pembelian->alamat = $request->alamat;
        $pembelian->tunggu_konfirmasi_supplier = 0;
        $pembelian->keterangan = $request->keterangan;
        $pembelian->sub_total = $request->sub_total;
        $pembelian->diskon_nominal = $request->diskon_nominal;
        $pembelian->biaya_lain_lain = $request->biaya_lain_lain;
        $pembelian->ppn = $request->ppn;
        $pembelian->grand_total = $request->grand_total;
        $pembelian->created_by =  $admin;
        $pembelian->updated_by = $admin;
        $pembelian->batal = 0;
        $pembelian->approval = 0;
        $pembelian->fid_user_approval = $admin;
        $pembelian->alasan_pembatalan = 'PO Di Edit';

        if($file = $request->hasFile('file_lembar_kerja')){

            $file =$request->file('file_lembar_kerja');

            $fileName = $file->getClientOriginalName();

            $destination = public_path().'/Assets/File_Kerja/';



            if(!file_exists($destination)){

                mkdir($destination, 0777, true);

            }

            $file->move($destination, $fileName);

            $pembelian->file_lembar_kerja = 'http://localhost:8000/Assets/File_Kerja/'.$fileName.$pembelian->id;
        }
        // dd($pembelian);
        if($pembelian->save()){
            $activity->save();

            if($request->has('productPembelian')){
                $product = $request->productPembelian;
                // dd($product);
                foreach($product as $productPembelian){
                    $alias = Barang_Alias::where('id',  $productPembelian['alias'])->first();
                    $barang = $alias->barang()->first();

                    if(array_key_exists('id', $productPembelian)){

                        $detailPembelian =  DetailPembelian::where('id', $productPembelian['id'])->first();
                        $detailPembelian->fid_pembelian = $pembelian->id;
                        $detailPembelian->fid_jenis_barang = $barang->fid_jenis_barang;
                        $detailPembelian->fid_barang = $alias->id;
                        $detailPembelian->fid_varian = $productPembelian['variasi'];
                        $detailPembelian->jumlah = $productPembelian['jumlah'];
                        $detailPembelian->harga_satuan = $productPembelian['harga_satuan'];
                        $detailPembelian->total =  $productPembelian['total'];
                        $detailPembelian->keterangan =  $productPembelian['keterangan'];
                        $detailPembelian->created_by = $admin;
                        $detailPembelian->updated_by = $admin;
                        //  dd($detailPembelian);
                        $detailPembelian->save();
                    }else{
                        $detailPembelian = new DetailPembelian();
                        $detailPembelian->fid_pembelian = $pembelian->id;
                        $detailPembelian->fid_jenis_barang = $barang->fid_jenis_barang;
                        $detailPembelian->fid_barang = $barang->id;
                        $detailPembelian->fid_varian = $productPembelian['variasi'];
                        $detailPembelian->jumlah = $productPembelian['jumlah'];
                        $detailPembelian->harga_satuan = $productPembelian['harga_satuan'];
                        $detailPembelian->total =  $productPembelian['total'];
                        $detailPembelian->keterangan =  $productPembelian['keterangan'];
                        $detailPembelian->created_by = $admin;
                        $detailPembelian->updated_by = $admin;
                        //  dd($detailPembelian);
                        $detailPembelian->save();
                    }

                }
            }

            return redirect()->route('purchase')->with('Success', 'Data Berhasil diubah');

        }else{
            return redirect()->back()->with('Faild', 'Gagal Edit Data ');
        }

    }
    public function approvedEditPO(Request $request,$id){
        $user = Auth()->user()->id;

        $activity = new User_Log();
        $activity->fid_user = $user;
        $activity->log = "Melakukan Approval Edit Purchase Order".$request->log;

        $purchase = Pembelian::find($id);
        $purchase->approval = true;
        $purchase->fid_user_approval = $user;
        $purchase->updated_at = Carbon::now()->toDateTimeString();

        $purchase->save();
        $activity->save();
        return response()->json(['success' => 1, 'data' => $purchase]);
    }

    public function requestCencelPO(Request $request, $id){
        $user = Auth()->user()->id;

        $activity = new User_Log();
        $activity->fid_user = $user;
        $activity->log = "Melakukan Pembatalan Purchase Order".$request->log;

        $purchase = Pembelian::find($id);
        $purchase->batal = true;
        $purchase->approval= false;
        $purchase->alasan_pembatalan = $request->alasan_pembatalan;

        $purchase->save();
        $activity->save();

        return response()->json(['success' => 1, 'data' => $purchase]);
    }

    public function getPembayaranPembelian(Request $request){
        $PO = $request->pembelian;
       $pembayaran =  DetailPembayaranPembelian::where('fid_pembelian', $PO)->get();
        return response()->json([
            'success' => 1,
            'message' => 'get data',
            'data' => $pembayaran
        ]);
    }

    public function postpembayaranPembelian(Request $request){

        $admin = Auth()->user()->id;
        $activity = new User_Log();

        $activity->fid_user = $admin;
        $activity->log = "Membuat Pembayaran Purchase Order".$request->log;
         // $sales = Penjualan::where('id', $request->id)->first();

        $pembayaran = new DetailPembayaranPembelian();
        $pembayaran->fid_pembelian =  $request->fid_pembelian;
        $pembayaran->tanggal = $request->tanggal;
        $pembayaran->type_pembayaran = $request->type_pembayaran;
        $pembayaran->total = $request->total;
        $pembayaran->total_ppn = $request->total_ppn;
        $pembayaran->total_bayar = $request->total_bayar;
        $pembayaran->keterangan = $request->keterangan;
        $pembayaran->diperiksa = $admin;
        $pembayaran-> created_by = $admin;
        $pembayaran-> updated_by = $admin;

        // dd($pembayaran);
        if($pembayaran->save()){
            //
            $activity->save();
            $Pembelian = Pembelian::where('id', $pembayaran->fid_pembelian)->first();
            $sumPembayaran  = DetailPembayaranPembelian::where('fid_pembelian', $pembayaran->fid_pembelian)->sum('total_bayar');
            if($sumPembayaran >= $Pembelian->grand_total){
                // $penjualan = Penjualan::where('id', $pembayaran->fid_penjualan)->first();
                $Pembelian->status = 'Lunas';
                // dd($penjualan);
                $Pembelian->update();
            }
            return redirect()->route('purchase')->with('Success', 'Berhasil menambahkan data baru');

        }else{
            return redirect()->back()->with('Faild', 'Gagal Menabahkan data baru');
        }
    }

    public function suratPO($id){
        $admin = Auth()->user()->id;
        $dec = decrypt($id);
        $purchase = Pembelian:: findOrFail($dec);
        $barang = DetailPembelian::where('fid_pembelian',$purchase->id)->get();
        $detail_sup = ContactPersonSupplier::where('fid_supplier', $purchase->fid_supplier)->first();

        return view('dashboard.part-lain.suratPO', compact('purchase','barang', 'detail_sup'));
    }
    public function suratPO_PT($id){
        $admin = Auth()->user()->id;
        $dec = decrypt($id);
        $purchase = Pembelian:: findOrFail($dec);
        $barang = DetailPembelian::where('fid_pembelian',$purchase->id)->get();
        $detail_sup = ContactPersonSupplier::where('fid_supplier', $purchase->fid_supplier)->first();
        $alamat_admin = GroupMember::where('fid_user', $admin)->first();
        return view('dashboard.part-lain.Surat_po_PT', compact('purchase','barang', 'detail_sup', 'alamat_admin'));
    }


}
