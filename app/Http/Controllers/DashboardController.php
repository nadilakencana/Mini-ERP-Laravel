<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_Role;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('logincek');
    }

    public function Dashboard(){
        return view('dashboard.index-Dashboard');
    }

    public function pembelian(){
        return view('dashboard.purchase.pembelian');
    }
    public function create_purchase(){
        return view('dashboard.purchase.create_purchase');
    }
    public function edit_purchase(){
        return view('dashboard.purchase.edit_purchase');
    }

    public function Sales(){
        return view('dashboard.salse.index-sales');
    }

    public function create_Sales(){
        return view('dashboard.salse.createSales');
    }

    public function edit_sales(){
       return view('dashboard.salse.editSales');
    }

    public function product(){
        return view('dashboard.product.index-product');
    }

    public function aliasProduct(){
        return view('dashboard.product.aliasProduct');
    }

    public function jenisProduct(){
        return view('dashboard.product.jenisProduct');
    }

    public function create_product(){
        return view('dashboard.product.create-product');
    }

    public function edit_product(){
        return view('dashboard.product.edit-product');
    }


    public function delivery(){
        return view('dashboard.Delivery.delivery_status');
    }


    public function edit_customer(){
        return view ('dashboard.customer.edit_customer');
    }

    public function create_customer(){
        return view('dashboard.customer.create_customer');
    }



}
