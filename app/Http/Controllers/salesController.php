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
use PhpParser\Node\Expr\List_;

class salesController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincek');
    }

    public function Sales(){
        $admin = Auth()->user()->id;
        $user = User::where('id', $admin)->with('role_admin')->whereHas('role_admin', function ($query) {
            $query->where('nama_role', 'Marketing');
        })
        ->first();
        $perPage = 2; // jumlah item data yang akan diambil setiap kali panggil
        $memberToko = GroupMember::where('fid_user', $admin)->first();
        // $aprovSO = Penjualan::where('fid_group', $memberToko->fid_group)->where('approval', '0')->orderBy('updated_at', 'desc')->paginate(2);
        if($user){
            $sales = Penjualan::where('fid_group', $memberToko->fid_group)->where('approval', '1')->where('batal', '0')->orderBy('updated_at', 'desc')->paginate(10);
            $aprovSO = Penjualan::where('fid_group', $memberToko->fid_group)->where('approval', '0')->orderBy('updated_at', 'desc')->paginate(10);
            $SOCencel = Penjualan::where('fid_group', $memberToko->fid_group)->where('batal', '1')->where('approval', '1')->orderBy('updated_at', 'desc')->paginate(10);

        }else{
            $sales = Penjualan::where('approval', '1')->where('batal', '0')->orderBy('updated_at', 'desc')->paginate(10);
            $aprovSO = Penjualan::where('approval', '0')->orderBy('updated_at', 'desc')->paginate(10);
            $SOCencel = Penjualan::where('batal', '1')->where('approval', '1')->orderBy('updated_at', 'desc')->paginate(10);
        }
        return view('dashboard.salse.index-sales', compact('sales','aprovSO','SOCencel'));
    }
    public function getDataSales(){
        $admin = Auth()->user()->id;
        $memberToko = GroupMember::where('fid_user', $admin)->first();
        $sales = Penjualan::where('fid_group', $memberToko->fid_group)->orderBy('updated_at', 'desc')->paginate(2);

        return view('dashboard.part-lain.data-sales', compact('sales'));
    }

    public function create_Sales(){

        $admin = Auth()->user()->id;


        $memberToko = GroupMember::where('fid_user', $admin)->first();
        $customer = Customer::all();
        $product = Product::all();
        $group = GroupToko::all();
        $jenis_barang = Barang_jenis::all();
        $aliasProduct = Barang_Alias::where('fid_group',  $memberToko->fid_group)->get();
        $getRelation = $memberToko->group()->first();
        $kode = $getRelation->kode_invoice;
        $date = Carbon::now(); //->Format('y/m/d');
        $y = $date->format('y');
        $m = $date->format('m');
        $d = $date->format('d');
        $invoiceKode = $kode.'/'.$y.'/'.$m.'/';

        $lastFaktur = Penjualan::where('no_faktur', 'LIKE', '%'.$invoiceKode.'%')->OrderBy('no_faktur','DESC')->first();
        // dd($lastFaktur);
        if($lastFaktur){
            $lastFakturs = $lastFaktur->no_faktur;
            $lastFakturs = explode('/', $lastFakturs);

            $lastFakturs = sprintf("%04d", intval($lastFakturs[count($lastFakturs)-1]) + 1);
            $PrefixFaktur = $invoiceKode.$d.'/'.$lastFakturs;
            // dd($PrefixFaktur);

        }else{
            $PrefixFaktur = $invoiceKode.$d.'/'.'0001';
        }

        $getInvoice = $PrefixFaktur;

        // dd($getInvoice);
        return view('dashboard.salse.createSales', compact(
            'customer',
            'product',
            'group',
            'aliasProduct',
            'getInvoice',
            'jenis_barang',

        ));
    }



     public function PostCreateData(Request $request){
        // dd($request);
        $admin = Auth()->user()->id;


        $activity = new User_Log();
        $activity->fid_user =  $admin ;
        $activity->log = "Membuat Sales Order ";

        $memberToko = GroupMember::where('fid_user', $admin)->first();
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
        $penjualan-> status = "Proses";
        $penjualan-> alasan_pembatalan = 0;
        $penjualan-> batal = 0;
        $penjualan-> approval = 1;
        $penjualan-> fid_user_approval = $admin;
        $penjualan-> created_by = $admin;
        $penjualan-> updated_by = $admin;
        //  dd( $penjualan);

        if($penjualan->save()){
            $activity->save();
            if($request->has('productSales')){
                // dd($request->has('productSales'));
                $products = $request->productSales;

                // dd(  $products  );
                foreach($products as $productSales ){

                    $alias = Barang_Alias::where('id',  $productSales['alias'])->first();
                    $barang = $alias->barang()->first();


                    $penjualanDetail = new DetailPenjualan();
                    $penjualanDetail-> fid_penjualan =  $penjualan->id;
                    $penjualanDetail-> fid_jenis_barang =   $barang->fid_jenis_barang;
                    $penjualanDetail-> fid_barang =   $alias->id; //alias barang
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

            if($penjualan->jenis_pengiriman == 'Ambil Sendiri' || $penjualan->jenis_pengiriman == 'Kirim dari toko'){
                $jenis = 'Normal';

            }elseif($penjualan->jenis_pengiriman == 'Kirim Dari Pabrik'){
                $jenis = 'Pabrik';
            }else{
                $jenis = 'Khusus';
            }

            $detailPengiriman = New DetailPengiriman();
            $detailPengiriman-> fid_penjualan = $penjualan->id;
            $detailPengiriman-> no_surat_jalan = $getNoSj ;
            $detailPengiriman-> tanggal_sj = $request->tanggal;
            $detailPengiriman-> tanggal_kirim = $request->tanggal_kirim;
            $detailPengiriman-> tipe = $request->jenis_pengiriman;
            $detailPengiriman-> alamat = $request->alamat;
            $detailPengiriman-> keterangan = $request->keterangan;
            $detailPengiriman-> customer = $request->customer;
            $detailPengiriman-> pengiriman = $request->pengiriman;
            $detailPengiriman-> jenis_surat_jalan = $jenis;
            $detailPengiriman-> created_by = $admin;
            $detailPengiriman-> updated_by = $admin;


            if($detailPengiriman->save()){
                   $listpengiriman = $request->input('itemPengiriman');
                   foreach($listpengiriman as $itemPengiriman){
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
            }

            return redirect()->route('sales')->with('Success', 'Berhasil menambahkan data baru');

        }else{
            return redirect()->back()->with('Faild', 'Gagal Menabahkan data baru');
        }


     }

     public function EditSales($id){

        $admin = Auth()->user()->id;

        $dec = decrypt($id);
        $Penjualan = Penjualan::findOrFail($dec);
        $detailPenjualan = DetailPenjualan::where('fid_penjualan', $Penjualan->id)->get();
        $pengiriman = DetailPengiriman::where('fid_penjualan',$Penjualan->id)->first();
        $detailPengiriman = List_Item_Pengiriman::where('fid_surat_jalan', $pengiriman->id)->get();
        // dd($detailPenjualan);
        // $variasiBarang = Barang_Varian::where('fid_jenis_barang', $detailPenjualan->fid_jenis_barang)->get();

        $memberToko = GroupMember::where('fid_user', $admin)->first();
        $customer = Customer::all();
        $product = Product::all();
        $group = GroupToko::all();
        $jenis_barang = Barang_jenis::all();
        $aliasProduct = Barang_Alias::where('fid_group',  $memberToko->fid_group)->get();
        $getRelation = $memberToko->group()->first();



        return view('dashboard.salse.editSales', compact(
            'Penjualan',
            'detailPenjualan',
            'detailPengiriman',
            'customer',
            'product',
            'group',
            'aliasProduct',
            'jenis_barang',

        ));
    }

    public function PostEdit(Request $request, $id){
        $admin = Auth()->user()->id;


        $activity = new User_Log();
        $activity->fid_user =  $admin ;
        $activity->log = "Edit Sales Order ";

        $memberToko = GroupMember::where('fid_user', $admin)->first();
        $group = $memberToko->group()->first();
        $dec = decrypt($id);


        $penjualan = Penjualan::findOrFail($dec);
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
        $penjualan-> fid_user_approval = 0;
        $penjualan->alasan_pembatalan = 'SO Di Edit';
        $penjualan-> created_by = $admin;
        $penjualan-> updated_by = $admin;
        //  dd( $penjualan);

        if($penjualan->save()){
            $activity->save();
            if($request->has('productSales')){
                // dd($request->has('productSales'));
                $products = $request->productSales;

                // dd(  $products  );
                foreach($products as $productSales ){
                    $alias = Barang_Alias::where('id',  $productSales['alias'])->first();
                    $barang = $alias->barang()->first();

                    if (array_key_exists('id', $productSales)){

                        $penjualanDetail = DetailPenjualan::where('id', $productSales['id'])->first();
                        $penjualanDetail-> fid_penjualan =  $penjualan->id;
                        $penjualanDetail-> fid_jenis_barang = $barang->fid_jenis_barang;
                        $penjualanDetail-> fid_barang = $alias->id;
                        $penjualanDetail-> fid_varian =  $productSales['variasi'];
                        $penjualanDetail-> jumlah=  $productSales['jumlah'];
                        $penjualanDetail-> harga_satuan =  $productSales['harga_satuan'];
                        $penjualanDetail-> total =   $productSales['total'];
                        $penjualanDetail-> keterangan =  $productSales['keterangan'];
                        $penjualanDetail-> created_by = $admin;
                        $penjualanDetail-> updated_by = $admin;
                        // dd($penjualanDetail);
                        $penjualanDetail->save();
                    }else{

                        $penjualanDetail = new DetailPenjualan();
                        $penjualanDetail-> fid_penjualan =  $penjualan->id;
                        $penjualanDetail-> fid_jenis_barang = $barang->fid_jenis_barang;
                        $penjualanDetail-> fid_barang = $alias->id;
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
            }


            $detailPengiriman = DetailPengiriman::where('fid_penjualan', $penjualan->id)->first();
            $detailPengiriman-> fid_penjualan = $penjualan->id;

            // $detailPengiriman-> no_surat_jalan = $getNoSj ;
            $detailPengiriman-> tanggal_sj = $request->tanggal;
            $detailPengiriman-> tanggal_kirim = $request->tanggal_kirim;
            $detailPengiriman-> tipe = $request->jenis_pengiriman;
            $detailPengiriman-> alamat = $request->alamat;
            $detailPengiriman-> keterangan = $request->keterangan;
            $detailPengiriman-> created_by = $admin;
            $detailPengiriman-> updated_by = $admin;

            if($detailPengiriman->save()){
                $listpengiriman = $request->input('itemPengiriman');
                foreach($listpengiriman as $itemPengiriman){
                 $alias = Barang_Alias::where('id',  $itemPengiriman['alias'])->first();
                 $barang = $alias->barang()->first();

                    if(array_key_exists('id', $itemPengiriman)){
                        $listItem = List_Item_Pengiriman::where('id', $itemPengiriman['id'])->first();
                        $listItem->fid_surat_jalan = $detailPengiriman->id;
                        $listItem->fid_jenis_barang = $barang->fid_jenis_barang;
                        $listItem->fid_barang =   $alias->id; //alias barang
                        $listItem->fid_varian = $itemPengiriman['variasi'];
                        $listItem->jumlah = $itemPengiriman['jumlah'];
                        $listItem->keterangan = $itemPengiriman['keterangan'];
                        $listItem->created_by = $admin;
                        $listItem->updated_by = $admin;

                        $listItem->save();
                    }else{
                        $listItem = new List_Item_Pengiriman();
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

             }
         }

            return redirect()->route('sales')->with('Success', 'Berhasil Edit data');

        }else{
            return redirect()->back()->with('Faild', 'Gagal Edit data ');
        }


    }
    public function approvedEdit(Request $request,$id){
        $user = Auth()->user()->id;

        $activity = new User_Log();
        $activity->fid_user = $user;
        $activity->log = "Melakukan Approval Edit Sales Order".$request->log;

        $Sales = Penjualan::find($id);
        $Sales->approval = true;
        $Sales->fid_user_approval = $user;
        $Sales->updated_at = Carbon::now()->toDateTimeString();

        $Sales->save();
        $activity->save();
        return response()->json(['success' => 1, 'data' => $Sales]);
    }

    public function requestCencelSO(Request $request, $id){
        $user = Auth()->user()->id;

        $activity = new User_Log();
        $activity->fid_user = $user;
        $activity->log = "Melakukan Pembatalan Sales Order".$request->log;

        $Sales = Penjualan::find($id);
        $Sales->batal = true;
        $Sales->approval= false;
        $Sales->alasan_pembatalan = $request->alasan_pembatalan;

        $Sales->save();
        $activity->save();

        return response()->json(['success' => 1, 'data' => $Sales]);
    }

     public function getAlamatCustomer(Request $request){
        $customer = Customer::where('id', $request->id)->first();
        return response()->json([
            'success' => 1,
            'message' => 'customer Berhasil Diambil',
            'data' => $customer
        ]);
     }

     public function getDataToko(Request $request){
        $groupToko = GroupToko::where('id', $request->id)->first();

        return response()->json([
            'success' => 1,
            'message' => 'Data Toko Berhasil Diambil',
            'data' => $groupToko
        ]);
     }

     public function getVariasi(Request $request){
        $productAlias = $request->barang;
        $barang = Product::where('id', $productAlias)->first();
        return Barang_Varian::where('fid_jenis_barang', $barang->fid_jenis_barang)->get()->pluck('id','nama_varian');
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
        $admin = Auth()->user()->id;
        $sales = $request->sales;
       $pembayaran =  DetailPembayaran::where('fid_penjualan', $sales)->get();
    //    $adminName =  DetailPembayaran::where('fid_penjualan', $sales)->get();
        return response()->json([
            'success' => 1,
            'message' => 'get data',
            'data' => $pembayaran,
            'admin'=>$admin
        ]);
    }

    public function postpembayaran(Request $request){
        $admin = Auth()->user()->id;

        $activity = new User_Log();
        $activity->fid_user =  $admin ;
        $activity->log = "Membuat pembayaran Sales Order ";


        $pembayaran = new DetailPembayaran();
        $pembayaran->fid_penjualan =  $request->fid_penjualan;
        $pembayaran->tanggal = $request->tanggal;
        $pembayaran->type_pembayaran = $request->type_pembayaran;
        $pembayaran->total = $request->total;
        $pembayaran->total_ppn = $request->total_ppn;
        $pembayaran->total_bayar = $request->total_bayar;
        $pembayaran->keterangan = $request->keterangan;
        $pembayaran->diperiksa = $admin;
        $pembayaran-> created_by = $admin;
        $pembayaran-> updated_by = $admin;


        if($pembayaran->save()){
            $activity->save();
                $penjualan = Penjualan::where('id', $pembayaran->fid_penjualan)->first();
                $sumPembayaran  = DetailPembayaran::where('fid_penjualan', $pembayaran->fid_penjualan)->sum('total_bayar');
                // dd($sumPembayaran);

                if($sumPembayaran >= $penjualan->grand_total){
                    // $penjualan = Penjualan::where('id', $pembayaran->fid_penjualan)->first();
                    $penjualan->status = 'Lunas';
                    // dd($penjualan);
                    $penjualan->update();
                }
            return redirect()->route('sales')->with('Success', 'Berhasil menambahkan data baru');

        }else{
            return redirect()->back()->with('Faild', 'Gagal Menabahkan data baru');
        }

    }

    public function updateStatus(Request $request){
        $idx = $request->penjualan;

    }

    public function invoice($id){
        $dec = decrypt($id);
        $sales = Penjualan::findOrFail($dec);
        $admin = Auth()->user()->id;
        $memberToko = GroupMember::where('fid_user', $admin)->first();
        $group = $memberToko->group()->first();
        $kodeGroup = $group->logo_toko;
        $detail = DetailPengiriman::where('fid_penjualan',$sales->id)->first();
        $barang = DetailPenjualan::where('fid_penjualan', $sales->id)->get();
        $pembayaran = DetailPembayaran::where('fid_penjualan', $sales->id)->first();
        $Total_Bayar = DetailPembayaran::where('fid_penjualan', $sales->id)->sum('total_bayar');
        return view('dashboard.part-lain.invoice', compact('sales','kodeGroup','detail','barang','pembayaran','Total_Bayar'));
    }

    public function suratJalan($id){

        $dec = decrypt($id);
        // $sales = ::findOrFail($dec);
        $admin = Auth()->user()->id;
        $memberToko = GroupMember::where('fid_user', $admin)->first();
        $group = $memberToko->group()->first();
        $kodeGroup = $group->logo_toko;
        $sj = DetailPengiriman::findOrFail($dec);
        $detail = List_Item_Pengiriman::where('fid_surat_jalan', $sj->id)->get();
        // $barang = DetailPenjualan::where('fid_penjualan', $sales->id)->get();


        return view('dashboard.part-lain.suratJalan', compact('kodeGroup','detail','sj'));
    }

    public function Kwitansi($id){
        // $dec = decrypt($id);
        $pembayaran = DetailPembayaran::where('id', $id)->first();
        $penjualan = Penjualan::where('id', $pembayaran->fid_penjualan)->first();

        // dd($penjualan);
        $customer = Customer::where('id', $penjualan->fid_customer)->first();
        // dd($customer);
        return view('dashboard.part-lain.kwitansi', compact('pembayaran', 'customer', 'penjualan'));
    }


}
