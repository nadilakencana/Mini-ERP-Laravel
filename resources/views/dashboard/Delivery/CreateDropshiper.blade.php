@extends('layoute.latoute')
@section('content')
<div class="card-content-display">
    <div class="header-display">
        <p class="text-tittle">
          Create Dropshiper
        </p>
    </div>
    <div class="head">
        <div class="part-head-left">
            <div class="i-form-sales Customer">
                <label for="nofaktur">Nama Customer</label>
                <input type="text" name="no_faktur" class="i-form nofaktur" value="{{   $getInvoice  }}" disabled>
            </div>
            <div class="alamat">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="" cols="25" rows="4"></textarea>
            </div>
        </div>
        <div class="part-head-right">
            <div class="Purchase-date tanggal">
                <label for="date-purchase">Sales Date</label>
                <input type="date" name="tanggal" id="sales_date">
            </div>
            <div class="Purchase-date pengiriman">
                <label for="date-purchase">Tanggal Kirim</label>
                <input type="date" name="tanggal_kirim" id="sales_date">
            </div>
            <div class="i-form-sales noFaktur">
                <label for="nofaktur">No Faktur</label>
                <input type="text" name="no_faktur" class="i-form nofaktur" value="{{   $getInvoice  }}" disabled>
            </div>
            <div class="i-form-sales seles">
                <label for="nofaktur">Sales</label>
                <input type="text"  class="i-form sales" value="{{ Auth()->user()->nama }}" disabled>
                <input type="hidden" name="fid_user" class="i-form admin_id" value="{{ Auth()->user()->id }}" disabled>
            </div>
            <div class="btn-act product">
                <div class="new-create">
                    New Product
                </div>
            </div>
            <div class="btn-act varian">
                <div class="new-create vr">
                    New Varian/Jenis
                </div>
            </div>
        </div>
    </div>
    <div class="form-table">
        <table class="table-form">
            <tr class="header-table">
                 <th class="header-row" style="width:151px">Product</th>
                 <th class="header-row" style="width:101px">Warna/Jenis</th>
                 <th class="header-row" style="width:185px">Description</th>
                 <th class="header-row" style="width:35px">Qty</th>
                 <th class="header-row" style="width:127px">Unit Price</th>
                 <th class="header-row" style="width:128px">Amount</th>
                 <th class="header-row" style="display:none"></th>
            </tr>

            <tr class="body-table" itemid="0">
                <td class="body-row input-row" data-row="0">
                    <div class="part-input alias">
                        <input type="text" class="input-tbl product" data-id="0">
                        <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="" class="input-icon" data-id="0">
                    </div>
                 </td>
                 <td class="body-row input-row variasi" data-row="0">
                    <select name= "productSales[0][variasi]" data-id="0" class="warna">
                        {{--  <option value="Hitam" data-id="" class="item-warna">Hitam</option>
                        <option value="Putih" data-id="" class="item-warna">Putih</option>
                        <option value="Cream" data-id="" class="item-warna">Cream</option>  --}}
                    </select>
                </td>
                 <td class="body-row input-row desc" data-row="0">
                    <input type="text" name="productSales[0][keterangan]"  class="input-tbl dsc" data-id="0">
                 </td>
                 <td class="body-row input-row qty" data-row="0">
                    <input type="text" name="productSales[0][jumlah]" class="input-tbl qty" data-id="0">
                 </td>
                 <td class="body-row input-row harga_satuan" data-row="0">
                    <input type="text" name="productSales[0][harga_satuan]" class="input-tbl unit_price" data-id="0">
                 </td>

                 <td class="body-row input-row amount" data-row="0">
                    <input type="text" name="productSales[0][total]" class="input-tbl amount" data-id="0">
                 </td>
                 <td class="body-row action-btn" data-id="0">
                    <div class="icon-plus">
                        <img src="{{ asset('Assets/icon/🦆 icon _plus_.png') }}" alt="" srcset="">
                    </div>
                    <div class="icon-delete" data-id="0">
                        <img src="{{ asset('Assets/icon/icon _trash_.png') }}" alt="" srcset="">
                    </div>
                 </td>
            </tr>
        </table>
         <div class="border-line"></div>
         <div class="border-line"></div>

         <div class="footer-form">
            <div class="f-from-l">
                <div class="catatan">
                    <label for="catatan">Catatan</label>
                    <div class="catatan-pembayaran">
                        <textarea class="keterangan-pembelian" name="keterangan" id="" cols="40" rows="5" value="" ></textarea>
                        {{--  <div class="icon-pembayaran">
                            <img src="{{ asset('Assets/icon/icon _money_.png') }}" alt="" srcset="">
                        </div>  --}}
                    </div>

                 </div>
                 <div class="jenis-pengiriman">
                    <div class="pengiriman">
                        <input type="radio" name="jenis_pengiriman" id="" value="Ambil Sendiri">
                        <label for="">Ambil Sendiri</label>

                    </div>
                    <div class="pengiriman">
                        <input type="radio" name="jenis_pengiriman" id="" value="Kirim Dari Pabrik">
                        <label for="">Kirim Dari pabrik</label>

                    </div>
                    <div class="pengiriman">
                        <input type="radio" name="jenis_pengiriman" id="" value="Kirim dari toko">
                        <label for="">Kirim dari Toko</label>

                    </div>
                 </div>
                 {{--  <div class="action-form-btn">
                    <div class="p-fak-form">
                        Print Faktur
                    </div>
                    <div class="p-sj-form">
                        Print Sj
                    </div>
                    <div class="p-kw-form">
                        Kwitansi
                    </div>
                 </div>  --}}
            </div>
            <div class="f-form-r">
                <div class="colum-total" style="margin-left: 200px;">
                    <p>SubTotal</p>
                    <p>=</p>
                    <input type="text" name="subtotal" value="" class="f-hasil subtotal" placeholder="0">
                </div>
                <div class="colum-total" style="margin-left: 134px;">
                    <p>Discount%</p><input type="text" class="f-input dis" placeholder="0">
                    <p>=</p>
                    <input type="text" name="diskon_nominal" value="" class="f-hasil disc" placeholder="0">
                </div>

                <div class="colum-total" style="margin-left: 166px;">
                    <p>PPN %</p><input type="text" class="f-input jumlah_ppn" placeholder="0">
                    <p>=</p>
                    <input type="text" name="ppn" value="" class="f-hasil ppn" placeholder="0">
                </div>
                <div class="colum-total" style="margin-left: 158px;">
                    <p>Biaya Lain-lain</p>
                    <p>=</p>
                    <input type="text" name="biaya_lain_lain" value="" class="f-hasil lain-lain" placeholder="0">
                </div>
                <div class="colum-total" style="margin-left: 183px;">
                    <p>Grand Total</p>
                    <p>=</p>
                    <input type="text" name="grand_total" value="" class="f-hasil grand_total" placeholder="0">
                </div>
            </div>
         </div>

         <div class="button-action-form">
            <div class="btn-save-form sales">Save</div>
            <a href="{{ url()->previous() }}">
                <div class="btn-cencel-form">Cancel</div>
            </a>
         </div>
    </div>

</div>

@stop
