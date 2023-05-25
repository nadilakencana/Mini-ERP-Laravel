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
        return view('dashboard.Delivery.Suratjalan', compact('sj','idx','detailSj','detailBarang'));
    }
}
