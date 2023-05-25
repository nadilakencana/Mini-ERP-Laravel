<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\salesController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\SuratJalanController;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// auth
Route::get('/',[AuthController::class,'viewLogin'])->name('login');
Route::post('/login-admin', [AuthController::class, 'postLogin'])->name('loginadmin');
Route::get('/logout', [AuthController::class, 'Logout'])->name('logout');
// Route::get('/surat-po', function(){
//     return view('dashboard.part-lain.suratPO');
// });
Route::group(['middleware' => ['logincek']], function(){

    Route::get('/Registrasi',[AuthController::class,'viewRegist'])->name('registrasi');
    Route::post('/daftar-admin', [AuthController::class, 'Regist'])->name('regist');
    Route::get('/Dashboard',[DashboardController::class,'Dashboard'])->name('dashboard');
    Route::post('/logout',[AuthController::class,'Logout'])->name('logout');
    Route::post('/edit_data-admin',[AuthController::class,'updateAdmin'])->name('update-edit');
    Route::get('/Update-data-admin',[AuthController::class,'EditUser'])->name('admin-edit');

    // purchasing
    Route::get('/pembelian',[PembelianController::class,'pembelian'])->name('purchase');
    Route::get('/create-data-purchase',[PembelianController::class,'create_purchase'])->name('crete-data-purchase');
    Route::post('/post-data-pembelian',[PembelianController::class ,'PostPemebelian'])->name('PostDataPembelian');
    Route::get('/get-data-pembayaran-pembelian',[PembelianController::class, 'getPembayaranPembelian'])->name('pembayaranPembelian');
    Route::post('/post-data-pembayaran-pembelian',[PembelianController::class, 'postpembayaranPembelian'])->name('postpembayaranPembelian');
    Route::get('/surat-po/{id}', [PembelianController::class,'suratPO'])->name('suratpo');
    Route::get('/Surat-Po-PT/{id}', [PembelianController::class,'suratPO_PT'])->name('suratpo-PT');
    Route::get('/load-data',[PembelianController::class,'getLoadData'])->name('loadData');
    Route::get('/data-detail-penjualan', [PembelianController::class,'getDetailPenjualan'])->name('getDetailPenjualan');

    // sales
    Route::get('/sales',[salesController::class,'Sales'])->name('sales');
    // Route::get('/edit-sales/{id}',[salesController::class,'edit_sales'])->name('edit-sales');
    Route::get('/create-sales',[salesController::class,'create_Sales'])->name('create-sales');
    Route::get('/get-varian',[salesController::class,'getVariasi'])->name('get-variasi');
    Route::get('/get-product', [salesController::class,'getProduct'])->name('getProduct');
    Route::post('/post-data-create-sales',[salesController::class,'PostCreateData'])->name('postDataSales');
    Route::post('/post-pembayaran',[salesController::class,'postpembayaran'])->name('postPembayaran');
    Route::get('/get-data-pembayaran',[salesController::class,'getPembayaran'])->name('pembayaran');
    Route::get('/invoice/{id}', [salesController::class, 'invoice'])->name('invoice');
    Route::get('/Surat-Jalan/{id}', [salesController::class, 'suratJalan'])->name('sj');
    Route::get('/kwitansi/{id}', [salesController::class, 'Kwitansi'])->name('kwitansi');
    Route::get('/get-data-customer', [salesController::class,'getAlamatCustomer'])->name('getCustomer');
    Route::get('data-toko', [salesController::class, 'getDataToko'])->name('getDataToko');
    Route::get('/data-sales', [salesController::class,'getDataSales'])->name('dataGetSales');
    Route::get('/data-master-barang',[ProductController::class,'getMasterBarang'])->name('masterBarang');
    Route::get('/edit-Sales-Order/{id}',[salesController::class,'EditSales'])->name('EditSo');
    Route::post('/update-data-so/{id}', [salesController::class,'PostEdit'])->name('updateSo');
    Route::post('/Approval-Edit-Sales-order/{id}',[salesController::class,'approvedEdit'])->name('approvalEdit');

    //surat jalan

    Route::get('/Surat-Jalan/{id}', [SuratJalanController::class,'listSuratJalan'])->name('ListSuratJalan');

    // product
    Route::get('/product',[ProductController::class, 'product'])->name('product');
    Route::get('/creat-product',[ProductController::class,'create_product'])->name('create-product');
    Route::get('/edit-product/{id}',[ProductController::class,'edit_product'])->name('edit-product');
    Route::post('/post-barang',[ProductController::class,'CreateProduct'])->name('post-barang');
    Route::post('/post-barang-in-sales',[ProductController::class,'CreateProductInSales'])->name('post-barang-inSales');
    Route::post('/update-barang/{id}',[ProductController::class,'UpdateProduct'])->name('update-barang');
    Route::delete('/delete-barang/{id}',[ProductController::class,'DeleteProduct'])->name('delete-barang');
    Route::post('/approved-product/{id}',[ProductController::class,'approvedProduct'])->name('approved');

    // Varian Product
    Route::post('/update-variaan', [ProductController::class, 'update_Varian'])->name('post-varian');
    Route::get('/edit-varian-product',[ProductController::class,'edit_varian'])->name('edit-varian');
    Route::delete('/delete-varian-product/{id}',[ProductController::class, 'DeleteVarian'])->name('delete-varian');

    //alias barang
    Route::get('/product-alias',[ProductController::class,'aliasProduct'])->name('Aliasproduct');
    Route::post('/update-data-alias',[ProductController::class,'update_data_alias'])->name('post-data-alias');
    Route::get('/edit-data-alias',[ProductController::class,'edit_alias'])->name('edit-data-alias');
    Route::delete('/delete-data-alias/{id}',[ProductController::class,'DeleteAlias'])->name('delete-data-alias');
    Route::post('/create-varian',[ProductController::class,'newVarian'])->name('multy-varian');

    // jenis barang
    Route::get('/Jenis-product',[ProductController::class,'jenisProduct'])->name('jenisProduct');
    Route::post('/update-data', [ProductController::class,'dataPost'])->name('updateDataJenis');
    Route::get('/edit-data-jenis-barang',[ProductController::class,'editdata'])->name('editDataJenis');
    Route::delete('/delete-data-jenis/{id}',[ProductController::class,'DeleteJenis'])->name('deleteJenis');

    // <!-- Supplier -->
    Route::get('/supplier', [SuplierController::class, 'supplier'])->name('supplier');
    Route::get('/edit-supplier/{id}',[SuplierController::class,'edit_supplier'])->name('edit-supplier');
    Route::get('/create-supplier',[SuplierController::class,'create_supplier'])->name('create-supplier');
    Route::post('/post-data-suplier',[SuplierController::class, 'post_suplier'])->name('post-suplier');
    Route::post('/update-data-suplier/{id}',[SuplierController::class, 'updateSuplier'])->name('update-suplier');
    Route::delete('/hapus-data/{id}', [SuplierController::class, 'delete_data_sp'])->name('hapus-data');
    // detail contact supllier
    Route::post('/post-contact', [SuplierController::class,'update_dataContact'])->name('upload-detail-contact');
    Route::get('/edit-contact-supplier',[SuplierController::class,'edit_contactSupplier'])->name('edit-contact-detail');
    Route::delete('/hapus-data-contact-detail/{id}', [SuplierController::class, 'delete_data_contact'])->name('hapus-data-detail-contact');



    // delivery
    Route::get('/delivery',[DashboardController::class, 'delivery'])->name('delivery');

    // customer
    Route::get('/customer', [CustomerController::class,'customer'])->name('customer');
    Route::get('/create-customer',[CustomerController::class,'create_customer'])->name('customer-create');
    Route::post('/post-data-customer',[CustomerController::class,'CreateCustomer'])->name('post-data-customer');
    Route::post('/update-data-customer/{id}',[CustomerController::class,'EditCustomer'])->name('update-data-customer');
    Route::get('/edit-customer/{id}',[CustomerController::class,'edit_customer'])->name('edit-customer');
    Route::delete('/delete-customer/{id}',[CustomerController::class,'delete_data_customer'])->name('delete-customer');
    Route::post('/post-data-customer-insales',[CustomerController::class,'CreateCustomerInSales'])->name('post-data-customer-insales');
    // contact detail customer
    Route::post('/post-contact-customer',[CustomerController::class,'updateContactDetail'])->name('upload-customer-contact');
    Route::get('/edit-contact-customer',[CustomerController::class,'edit_contactCustomer'])->name('edit-customer-contact');

    // user
    Route::get('/data-user',[UserRoleController::class,'dataUser'])->name('dataUser');
    Route::get('/data-user-role',[UserRoleController::class,'dataRole'])->name('dataRole');
    Route::get('/create-user-role',[UserRoleController::class,'createRole'])->name('createRole');
    Route::post('/post-data-role',[UserRoleController::class,'postData'])->name('post.role');
    Route::get('/edit-role',[UserRoleController::class,'editRole'])->name('edit.role');
    Route::delete('/delete-data-role/{di}',[UserRoleController::class,'DeleteData'])->name('DeleteRole');


    // Group
    // groupToko
    Route::get('/data-group',[GroupController::class,'dataGroup'])->name('dataGroup');
    Route::get('/create-group',[GroupController::class,'CreateGroup'])->name('createGroup');
    Route::get('/edit-group/{id}',[GroupController::class,'EditGroup'])->name('EditGroup');
    Route::post('/post-create-Group', [GroupController::class,'postDataGroup'])->name('createdatagroup');
    Route::delete('/delete-data/{di}',[GroupController::class,'DeleteData'])->name('DeleteGroup');
    Route::post('/update-create-Group/{id}', [GroupController::class,'updateData'])->name('updatedatagroup');

    //group member
    Route::get('/data-group-member',[GroupController::class,'dataGroupMember'])->name('dataGroupMember');
    Route::get('/create-group-member',[GroupController::class,'CreateGroupMember'])->name('createGroupMember');
    Route::get('/edit-data-member/{id}',[GroupController::class,'EditGroupMember'])->name('edit_member');
    Route::post('/post-create/member',[GroupController::class,'create_member'])->name('post_member');
    Route::post('/update_data_member/{id}',[GroupController::class,'edit_member'])->name('update_member');
    Route::delete('/Delete-member-group/{id}',[GroupController::class,'DeleteDataMember'])->name('deleteMemeber');



});
