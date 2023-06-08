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
use App\Models\Pembelian;
use Illuminate\Support\Carbon;
use App\Models\User_Log;
use App\Models\User;
use App\Models\List_Item_Pengiriman;
use App\Models\Status_log_SJ;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;
use PDF;

class SuratJalanController extends Controller
{
    public function listSuratJalan(Request $request, $id){
        $admin = Auth()->user()->id;

        $dec = decrypt($id);
        $sj = DetailPengiriman::where('fid_penjualan', $dec)->orderBy('updated_at', 'desc')->get();
        $idx = Penjualan::where('id', $dec)->first();

        $detailSj= DetailPengiriman::where('fid_penjualan', $dec)->first();
        $detailBarang= List_Item_Pengiriman::where('fid_surat_jalan', $detailSj->id)->get();
        $memberToko = GroupMember::where('fid_user',  $detailSj->created_by)->first();
        $getRelation = $memberToko->group()->first();
        $kode = $getRelation->kode_invoice;

        return view('dashboard.Delivery.Suratjalan', compact('sj','idx','detailSj','detailBarang','kode'));
    }

    public function DropshiperSj(Request $request, $id){
        $admin = Auth()->user()->id;

        $dec = decrypt($id);

        $memberToko = GroupMember::where('fid_user', $admin)->first();
        $product = Product::all();
        $group = GroupToko::all();
        $jenis_barang = Barang_jenis::all();
        $aliasProduct = Barang_Alias::where('fid_group',  $memberToko->fid_group)->get();
        $group = $memberToko->group()->first();
        $kodeGroup = $group->kode_invoice;
        $date = Carbon::now();
       //->Format('y/m/d');
        $y = $date->format('y');
        $m = $date->format('m');
        $d = $date->format('d');
        $noSuratJalan = 'SJ/'.$kodeGroup.'/'.$y.'/'.$m.'/';

        $lastNoSj = DetailPengiriman::where('no_surat_jalan', 'LIKE', '%'.$noSuratJalan .'%')->OrderBy('no_surat_jalan', 'DESC')->first();

        if($lastNoSj){
            $lastSuratJalan = $lastNoSj->no_surat_jalan;
            $lastSuratJalan = explode('/',   $lastSuratJalan);

            $lastSuratJalan = sprintf("%04d", intval($lastSuratJalan[count($lastSuratJalan)-1]) + 1);
            $prefixSuratJalan =  $noSuratJalan.$d.'/'.$lastSuratJalan;
        }else{
            $prefixSuratJalan = $noSuratJalan.$d.'/'.'0001';

        }

        $getNoSj = $prefixSuratJalan;

        $detailSj= DetailPengiriman::where('fid_penjualan', $dec)->first();
        $detailBarang= List_Item_Pengiriman::where('fid_surat_jalan', $detailSj->id)->get();
        $idx = Penjualan::where('id', $dec)->first();

        return view('dashboard.Delivery.CreateDropshiper',  compact(
            'getNoSj',
            'detailSj',
            'detailBarang',
            'product',
            'group',
            'jenis_barang',
            'aliasProduct',
            'idx'
        ));
    }

    public function postdropshiperSJ(Request $request, $id){

        $admin = Auth()->user()->id;

         $dec = decrypt($id);
         $detailSj= DetailPengiriman::where('fid_penjualan', $dec)->first();
         $idx = Penjualan::where('id', $dec)->first();

        $activity = new User_Log();
        $activity->fid_user =  $admin ;
        $activity->log = "Membuat Surat Jalan Dropship ";

        $detailPengiriman = New DetailPengiriman();
        $detailPengiriman-> fid_penjualan = $detailSj->fid_penjualan;
        $detailPengiriman-> no_surat_jalan =$request->no_surat_jalan  ;
        $detailPengiriman-> tanggal_sj = $request->tanggal_sj;
        $detailPengiriman-> tanggal_kirim = $request->tanggal_kirim;
        $detailPengiriman-> tipe = $request->tipe;
        $detailPengiriman-> alamat = $request->alamat;
        $detailPengiriman-> keterangan = $request->keterangan;
        $detailPengiriman-> customer = $request->customer;
        $detailPengiriman-> pengiriman = $request->tipe;
        $detailPengiriman-> jenis_surat_jalan = $request->jenis_surat_jalan;
        $detailPengiriman-> created_by = $admin;
        $detailPengiriman-> updated_by = $admin;

        // dd($detailPengiriman);
        if($detailPengiriman->save()){
               $listpengiriman = $request->input('itemPengiriman');
               foreach($listpengiriman as $itemPengiriman){
                // dd($itemPengiriman);
                $alias = Barang_Alias::where('id',  $itemPengiriman['alias'])->first();
                $barang = $alias->barang()->first();

                   $listItem = New List_Item_Pengiriman();
                   $listItem->fid_surat_jalan = $detailPengiriman->id;
                   $listItem->fid_jenis_barang = $barang->fid_jenis_barang;
                   $listItem->fid_barang =   $alias->id; //alias barang
                   $listItem->fid_varian = $itemPengiriman['variasi'];
                   $listItem->jumlah = $itemPengiriman['jumlah'];
                   $listItem->keterangan = $itemPengiriman['keterangan'];
                   $listItem->created_by = $admin;
                   $listItem->updated_by = $admin;

                   $listItem->save();
            }

            return redirect()->route('ListSuratJalan', encrypt($dec))->with('Success', 'Berhasil menambahkan data baru');
        }else{
            return redirect()->back()->with('Faild', 'Gagal Menabahkan data baru');
        }

    }

    public function postStatus(Request $request){

        $admin = Auth()->user()->id;
        $surat_jalan = DetailPengiriman::where('id',  $request->id)->first();

        $status_print = Status_log_SJ::where('fid_surat_jalan', $surat_jalan->id)->latest()->first();
        //dd($status_print->cetak_ke + 1);
        $status = new Status_log_SJ();
        $status->fid_surat_jalan = $surat_jalan->id;
        $status->tanggal_cetak = Carbon::now()->format('d-m-y');
        $status->user_cetak= $admin;
        if($status_print == null){
            $status->cetak_ke = 1;
        }else{
            $status->cetak_ke = $status_print->cetak_ke + 1;
        }

        $status->status = 'Sudah Di Print';
        //dd($status);
        $status->save();

        return response()->json([
            'status' => 1,
            'message' => 'berhasil',
        ]);
    }
}
