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

class PembelianController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('logincek');
    }


    public function pembelian(){
        $admin = Auth()->user()->id;
         $memberToko = GroupMember::where('fid_user', $admin)->first();
        $Pembelian = Pembelian::where('fid_group', $memberToko->fid_group)->orderBy('updated_at', 'desc')->paginate(2);
        return view('dashboard.purchase.pembelian', compact('Pembelian'));
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
			// if(  $k < count($DetailPenjualan->toArray()) - 1){
			// 	$varianString = $varianString.$varian->variasi.', ';
			// }else{
			// 	$varianString = $varianString.$varian->variasi;
			// }

		}


        return view('dashboard.part-lain.detail_penjualan', compact('Penjualan', 'DetailPenjualan'));

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
        $pembelian->batal = 0;
        $pembelian->approval = 0;
        $pembelian->fid_user_approval = $admin;
        $pembelian->alasan_pembatalan = 0;

        // dd($pembelian);
        if($pembelian->save()){

            if($request->has('productPembelian')){
                $product = $request->productPembelian;
                // dd($product);
                foreach($product as $productPembelian){
                    $alias = Barang_Alias::where('id',  $productPembelian['alias'])->first();
                    $barang = $alias->barang()->first();

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



            // $pembayaran = new DetailPembayaranPembelian();
            // $pembayaran->fid_pembelian =  $pembelian->id;
            // $pembayaran->tanggal = $request->tanggal_pembayaran;
            // $pembayaran->pembayaran = $request->pembayaran;
            // $pembayaran->total = $request->total;
            // $pembayaran->keterangan = $request->deskripPembayaran;
            // $pembayaran->diperiksa = $admin;
            // $pembayaran-> created_by = $admin;
            // $pembayaran-> updated_by = $admin;

            // $pembayaran->save();



        return redirect()->route('purchase')->with('Success', 'Berhasil menambahkan data baru');

        }else{
            return redirect()->back()->with('Faild', 'Gagal Menabahkan data baru');
        }

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

         // $sales = Penjualan::where('id', $request->id)->first();

        $pembayaran = new DetailPembayaranPembelian();
        $pembayaran->fid_pembelian =  $request->fid_pembelian;
        $pembayaran->tanggal = $request->tanggal;
        $pembayaran->pembayaran = $request->pembayaran;
        $pembayaran->total = $request->total;
        $pembayaran->keterangan = $request->keterangan;
        $pembayaran->diperiksa = $admin;
        $pembayaran-> created_by = $admin;
        $pembayaran-> updated_by = $admin;

        // dd($pembayaran);
        if($pembayaran->save()){
            //
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
