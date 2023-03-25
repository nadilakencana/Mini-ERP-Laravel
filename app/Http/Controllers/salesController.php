<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Barang_Alias;
use App\Models\Barang_jenis;
use App\Models\Barang_Varian;
use App\Models\DetailPembayaran;
use App\Models\DetailPengiriman;
use App\Models\GroupToko;
use App\Models\GroupMember;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;
use PDF;

class salesController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincek');
    }

    public function Sales(){
        $sales = Penjualan::orderBy('updated_at', 'desc')->get();
        return view('dashboard.salse.index-sales', compact('sales'));
    }

    public function create_Sales(){

        $admin = Auth()->user()->id;

        $memberToko = GroupMember::where('fid_user', $admin)->first();
        $customer = Customer::all();
        $product = Product::all();
        $group = GroupToko::all();
        $aliasProduct = Barang_Alias::where('fid_group',  $memberToko->fid_group)->get();
        $getRelation = $memberToko->group()->first();
        $kode = $getRelation->kode_invoice;
        $date = Carbon::now()->Format('y/m/d');
        $invoiceKode = $kode.'/'.$date.'/';

        $lastFaktur = Penjualan::where('no_faktur', 'LIKE', '%'. $kode.'%')->OrderBy('no_faktur','ASC')->first();
        // dd($lastFaktur);
        if($lastFaktur){
            $lastFakturs = $lastFaktur->no_faktur;
            $lastFakturs = explode($invoiceKode, $lastFakturs);

            $lastFakturs = sprintf("%04d", intval($lastFakturs) + 1);
            $PrefixFaktur = $invoiceKode.$lastFakturs;
            // dd($PrefixFaktur);

        }else{
            $PrefixFaktur = $invoiceKode.'0001';
        }

        $getInvoice = $PrefixFaktur;

        // dd($getInvoice);



        return view('dashboard.salse.createSales', compact(
            'customer',
            'product',
            'group',
            'aliasProduct',
            'getInvoice',

        ));
    }


     public function PostCreateData(Request $request){
        // dd($request);
        $admin = Auth()->user()->id;

        $memberToko = GroupMember::where('fid_user', $admin)->first();
        $group = $memberToko->group()->first();
        $kodeGroup = $group->kode_invoice;
        $date = Carbon::now()->Format('y/m/d');
        $noSuratJalan = 'SJ/'.$kodeGroup.'/'.$date.'/';

        $lastNoSj = DetailPengiriman::where('no_surat_jalan', 'LIKE', '%'.$kodeGroup.'%')->OrderBy('no_surat_jalan', 'ASC')->first();

        if($lastNoSj){
            $lastSuratJalan = $lastNoSj->no_surat_jalan;
            $lastSuratJalan = explode($noSuratJalan, $lastNoSj);

            $lastSuratJalan = sprintf("%04d", intval($lastSuratJalan) + 1);
            $prefixSuratJalan = $noSuratJalan.$lastSuratJalan;
        }else{
            $prefixSuratJalan = $noSuratJalan.'0001';

        }

        $getNoSj = $prefixSuratJalan;

        $penjualan = new Penjualan();
        $penjualan-> no_faktur = $request->no_faktur;
        $penjualan-> fid_group =  $memberToko->fid_group;
        $penjualan-> fid_user = $admin;
        $penjualan-> fid_customer = $request->fid_customer;
        $penjualan-> tanggal = $request->tanggal;
        $penjualan-> tanggal_kirim = $request->tanggal_kirim;
        $penjualan-> tunggu_konfirmasi_customer = 0 ;
        $penjualan-> jenis_pengiriman = $request->jenis_pengiriman;
        $penjualan-> keterangan = $request->keterangan;
        $penjualan-> sub_total = $request->sub_total;
        $penjualan-> diskon_nominal = $request->diskon_nominal;
        $penjualan-> biaya_lain_lain = $request->biaya_lain_lain;
        $penjualan-> ppn = $request->ppn;
        $penjualan-> grand_total = $request->grand_total;
        $penjualan-> alasan_pembatalan = 0;
        $penjualan-> batal = 0;
        $penjualan-> approval = 0;
        $penjualan-> fid_user_approval = $admin;
        $penjualan-> created_by = $admin;
        $penjualan-> updated_by = $admin;
        //  dd( $penjualan);

        if($penjualan->save()){

            if($request->has('productSales')){
                // dd($request->has('productSales'));
                $products = $request->productSales;

                // dd(  $products  );
                foreach($products as $productSales ){

                    $alias = Barang_Alias::where('id',  $productSales['alias'])->first();
                    $barang = $alias->barang()->first();


                    $penjualanDetail = new DetailPenjualan();
                    $penjualanDetail-> fid_penjualan =  $penjualan->id;
                    $penjualanDetail-> fid_jenis_barang = $barang->fid_jenis_barang;
                    $penjualanDetail-> fid_barang = $barang->id;
                    $penjualanDetail-> fid_varian =  $productSales['variasi'];
                    $penjualanDetail-> jumlah=  $productSales['jumlah'];
                    $penjualanDetail-> harga_satuan =  $productSales['harga_satuan'];
                    $penjualanDetail-> total =   $productSales['total'];
                    $penjualanDetail-> keterangan =  $productSales['keterangan'];
                    $penjualanDetail-> created_by = $admin;
                    $penjualanDetail-> updated_by = $admin;
                    // dd($penjualanDetail);
                    $penjualanDetail->save();

                }
            }


            $detailPengiriman = New DetailPengiriman();
            $detailPengiriman-> fid_penjualan = $penjualan->id;
            $detailPengiriman-> no_surat_jalan = $getNoSj ;
            $detailPengiriman-> tanggal_sj = $request->tanggal;
            $detailPengiriman-> tanggal_kirim = $request->tanggal_kirim;
            $detailPengiriman-> tipe = $request->jenis_pengiriman;
            $detailPengiriman-> alamat = $request->alamat;
            $detailPengiriman-> keterangan = $request->keterangan;
            $detailPengiriman-> created_by = $admin;
            $detailPengiriman-> updated_by = $admin;

            $detailPengiriman->save();

            $pembayaran = new DetailPembayaran();
            $pembayaran->fid_penjualan =  $penjualan->id;
            $pembayaran->tanggal = $request->tanggal_pembayaran;
            $pembayaran->pembayaran = $request->pembayaran;
            $pembayaran->total = $request->total;
            $pembayaran->keterangan = $request->deskripPembayaran;
            $pembayaran->diperiksa = $admin;
            $pembayaran-> created_by = $admin;
            $pembayaran-> updated_by = $admin;

            $pembayaran->save();



            return redirect()->route('sales')->with('Success', 'Berhasil menambahkan data baru');

        }else{
            return redirect()->back()->with('Faild', 'Gagal Menabahkan data baru');
        }



     }



     public function getVariasi(Request $request){
        $productAlias = $request->barang;
        return Barang_Varian::where('fid_barang', $productAlias)->get()->pluck('id','nama_varian');
     }

     public function getProduct(Request $request){
        $product = Barang_Alias::where('id', $request->id)->first();
        return response()->json([
            'success' => 1,
            'message' => 'Role Berhasil Diambil',
            'data' => $product
        ]);
     }


    public function getPembayaran(Request $request){
        $sales = $request->sales;
       $pembayaran =  DetailPembayaran::where('fid_penjualan', $sales)->get();
        return response()->json([
            'success' => 1,
            'message' => 'get data',
            'data' => $pembayaran
        ]);
    }

    public function postpembayaran(Request $request){
        $admin = Auth()->user()->id;

         // $sales = Penjualan::where('id', $request->id)->first();

        $pembayaran = new DetailPembayaran();
        $pembayaran->fid_penjualan =  $request->fid_penjualan;
        $pembayaran->tanggal = $request->tanggal;
        $pembayaran->pembayaran = $request->pembayaran;
        $pembayaran->total = $request->total;
        $pembayaran->keterangan = $request->keterangan;
        $pembayaran->diperiksa = $admin;
        $pembayaran-> created_by = $admin;
        $pembayaran-> updated_by = $admin;


    if($pembayaran->save()){
        //
        return redirect()->route('sales')->with('Success', 'Berhasil menambahkan data baru');

    }else{
        return redirect()->back()->with('Faild', 'Gagal Menabahkan data baru');
    }

    }
    public function edit_sales($id){
        $admin = Auth()->user()->id;
        $dec = decrypt($id);
        $sales = Penjualan::findOrFail($dec);
        $memberToko = GroupMember::where('fid_user', $admin)->first();
        $customer = Customer::all();
        $product = Product::all();
        $group = GroupToko::all();
        $aliasProduct = Barang_Alias::where('fid_group',  $memberToko->fid_group)->get();

        return view('dashboard.salse.editSales', compact('sales','memberToko','customer','product','group','aliasProduct'));
    }

    public function invoice($id){
        $dec = decrypt($id);
        $sales = Penjualan::findOrFail($dec);
        $admin = Auth()->user()->id;
        $memberToko = GroupMember::where('fid_user', $admin)->first();
        $group = $memberToko->group()->first();
        $kodeGroup = $group->kode_invoice;
        $detail = DetailPengiriman::where('fid_penjualan',$sales->id)->first();
        $barang = DetailPenjualan::where('fid_penjualan', $sales->id)->get();
        $pembayaran = DetailPembayaran::where('fid_penjualan', $sales->id)->first();
        return view('dashboard.part-lain.invoice', compact('sales','kodeGroup','detail','barang','pembayaran'));
    }
    public function suratJalan($id){
        $dec = decrypt($id);
        $sales = Penjualan::findOrFail($dec);
        $admin = Auth()->user()->id;
        $memberToko = GroupMember::where('fid_user', $admin)->first();
        $group = $memberToko->group()->first();
        $kodeGroup = $group->kode_invoice;
        $detail = DetailPengiriman::where('fid_penjualan',$sales->id)->first();
        $barang = DetailPenjualan::where('fid_penjualan', $sales->id)->get();
        $sj = DetailPengiriman::where('fid_penjualan',$sales->id)->first();
        return view('dashboard.part-lain.suratJalan', compact('sales','kodeGroup','detail','barang','sj'));
    }


}
