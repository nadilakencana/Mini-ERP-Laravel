@extends('layoute.latoute')
@section('content')
{{--  card-content  --}}
<div class="card-content-display">
    <div class="header-display">
        <p class="text-tittle">
          Edit Purchase
        </p>
    </div>
    <div class="head">
        <div class="part-head-left">
            <div class="vendor-selection">
                <label for="vendor">Supplier</label>
                <select name="fid_supplier" id="" placeholder="Select Vendor" class="input-f supplier">
                    <option value="{{ $pembelian->fid_supplier }}" class="old-customer" selected>{{$pembelian->suplier->nama_supplier}}</option>
                    @foreach ($supplier as $sp )
                        <option value="{{ $sp->id }}">{{ $sp->nama_supplier }}</option>
                    @endforeach
                </select>
            </div>
            <div class="alamat">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="" cols="25" rows="4">{{ $pembelian->alamat }}</textarea>
            </div>
            <div class="Purchase-date File">
                <label for="date-purchase">Upload Lembar Kerja</label>
                <input type="file" name="file_lembar_kerja" id="file_upload" value="{{ $pembelian->file_lembar_kerja }}">
            </div>
        </div>
        <div class="part-head-right">

            <div class="Purchase-date tanggal">
                <label for="date-purchase">PO Date</label>
                <input type="date" name="tanggal" id="sales_date" value="{{ $pembelian->tanggal }}">
            </div>
            <div class="Purchase-date pengiriman">
                <label for="date-purchase">Tanggal Kirim</label>
                <input type="date" name="tanggal_kirim" id="date_po" value="{{ $pembelian->tanggal_kirim }}">
            </div>
            <div class="i-form-sales noFaktur">
                <label for="nofaktur">No PO</label>
                <input type="text" name="faktur" class="i-form nofaktur" value="{{  $pembelian->no_faktur }}" disabled>
            </div>
            <div class="i-form-sales">
                <label for="nofaktur">Admin</label>
                <input type="text" class="i-form sales" value="{{ $pembelian->admin->username }}" disabled>
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
            @foreach ($detailPembelian as $k => $detail )
            <tr class="body-table" itemid="{{ $k }}">
                <td class="body-row input-row" data-row="{{ $k }}">
                    <div class="part-input alias">
                        <input type="text" class="input-tbl product" data-id="{{ $k }}" value="{{ $detail->AliasBarang->alias }}">
                        <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="" class="input-icon" data-id="{{ $k }}">
                    </div>
                 </td>
                 <td class="body-row input-row variasi" data-row="{{ $k }}">
                    <select name= "productPembelian[{{ $k }}][variasi]" data-id="{{ $k }}" class="warna">
                        <option value="{{ $detail->fid_varian }}" selected>{{ $detail->variasi->nama_varian }}</option>
                        {{--  @foreach ($variasi as $var )
                        <option value="{{ $var->id }}" >{{ $var->nama_varian }}</option>
                        @endforeach  --}}
                    </select>
                </td>
                 <td class="body-row input-row desc" data-row="{{ $k }}">
                    <input type="text" name="productPembelian[{{ $k }}][keterangan]"  class="input-tbl dsc" data-id="{{ $k }}" value="{{ $detail->keterangan }}">
                 </td>
                 <td class="body-row input-row qty" data-row="{{ $k }}">
                    <input type="text" name="productPembelian[{{ $k }}][jumlah]" class="input-tbl qty" data-id="{{ $k }}" value="{{ $detail->jumlah }}">
                 </td>
                 <td class="body-row input-row harga_satuan" data-row="{{ $k }}">
                    <input type="text" name="productPembelian[{{ $k }}][harga_satuan]" class="input-tbl unit_price" data-id="{{ $k }}"value="{{ $detail->harga_satuan }}">
                 </td>

                 <td class="body-row input-row amount" data-row="{{ $k }}">
                    <input type="text" name="productPembelian[{{ $k }}][total]" class="input-tbl amount" data-id="{{ $k }}" value="{{ $detail->total }}">
                 </td>
                 <td class="body-row action-btn" data-id="{{ $k }}">
                    <div class="icon-plus">
                        <img src="{{ asset('Assets/icon/🦆 icon _plus_.png') }}" alt="" srcset="">
                    </div>
                    <div class="icon-delete" data-id="{{ $k }}">
                        <img src="{{ asset('Assets/icon/icon _trash_.png') }}" alt="" srcset="">
                    </div>
                 </td>
            </tr>
            @endforeach

        </table>
         <div class="border-line"></div>
         <div class="border-line"></div>

         <div class="footer-form">
            <div class="f-from-l">
                <div class="catatan">
                    <label for="catatan">Catatan</label>
                    <div class="catatan-pembayaran">
                        <textarea name="keterangan" id="" cols="40" rows="5" class="keterangan-pembelian">{{ $pembelian->keterangan }}</textarea>

                    </div>

                 </div>

            </div>
            <div class="f-form-r">
                <div class="colum-total" style="margin-left: 200px;">
                    <p>SubTotal</p>
                    <p>=</p>
                    <input type="text" name="subtotal" value="{{ $pembelian->sub_total }}" class="f-hasil subtotal" placeholder="0">
                </div>
                <div class="colum-total" style="margin-left: 134px;">
                    <p>Discount%</p><input type="text" class="f-input dis" placeholder="0">
                    <p>=</p>
                    <input type="text" name="diskon_nominal" value="{{ $pembelian->diskon_nominal }}" class="f-hasil disc" placeholder="0">
                </div>

                <div class="colum-total" style="margin-left: 166px;">
                    <p>PPN %</p><input type="text" class="f-input jumlah_ppn" placeholder="0">
                    <p>=</p>
                    <input type="text" name="ppn" value="{{ $pembelian->ppn }}" class="f-hasil ppn" placeholder="0">
                </div>
                <div class="colum-total" style="margin-left: 158px;">
                    <p>Biaya Lain-lain</p>
                    <p>=</p>
                    <input type="text" name="biaya_lain_lain" value="{{ $pembelian->biaya_lain_lain }}" class="f-hasil lain-lain" placeholder="0">
                </div>
                <div class="colum-total" style="margin-left: 183px;">
                    <p>Grand Total</p>
                    <p>=</p>
                    <input type="text" name="grand_total" value="{{ $pembelian->grand_total }}" class="f-hasil grand_total" placeholder="0">
                </div>
            </div>
         </div>

         <div class="button-action-form">
            <div class="btn-save-form pembelian">Save</div>
            <a href="{{ url()->previous() }}">
                <div class="btn-cencel-form">Cancel</div>
            </a>
         </div>
    </div>

</div>


{{--  popup product   --}}
<div class="container-popup-card-product close-hide">
    <div class="card-position ">
        <div class="card-create-customer alias-Product close-hide" style="width: 885px;">
            <div class="header-card-create">
                <p class="text-tittle">
                  Alias Product
                </p>
                <p class="close close-pop"> X </p>
            </div>
           <div class="action">
                <div class="box-search">
                    <div class="icon-search">
                        <img src="{{ asset('Assets/icon/🦆 icon _search_.png') }}" alt="" srcset="">
                    </div>
                    <p>Search</p>
                </div>

           </div>
           <div class="tbl-product">
                <div class="table-data">
                    @php $no=1; @endphp
                    <table>
                        <tr class="header-table">
                            <th class="header-row" >No</th>
                            <th class="header-row" style="width:200px">Kode Barang/Jasa</th>
                            <th class="header-row" style="width:302px">Nama Barang/Jasa</th>
                            <th class="header-row" style="width:177px">Alias</th>
                            <th class="header-row" style="width:234px">Group</th>
                            <th class="header-row" style="width:200px">Action</th>
                        </tr>
                        @foreach ( $aliasProduct as $product )
                            <tr class="body-table" itemid="1">
                                <td class="body-row">{{ $no++ }}</td>
                                <td class="body-row" ><a href="">{{ $product->barang->kode }}</a></td>
                                <td class="body-row">{{ $product->barang->nama_barang }}</td>
                                <td class="body-row">{{ $product->alias }} </td>
                                <td class="body-row">{{ $product->group->nama_toko }}</td>
                                <td class="body-row"><input type="checkbox" class="selection-check" id="checkbox" data-item="{{ $product->id }}" data-barang="{{ $product->fid_barang }}"></td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
            <div class="btn-footer">
                <div class="btn-ok" data-item="">
                    Ok
                </div>
            </div>
        </div>
    </div>
</div>


<div class="submit-form">
    <form class="hidden" action="{{route('PostEditDataPO', encrypt($pembelian->id))}}" method="POST"  enctype="multipart/form-data">
        @csrf

        {{--  //tb pembelian  --}}
        <input type="hidden" name="faktur" class="input-hide no_faktur"/>
        <input type="hidden" name="fid_supplier" class="input-hide customer"/>
        <input type="hidden" name="tanggal" class="input-hide tanggal"/>
        <input type="hidden" name="tanggal_kirim" class="input-hide tanggal_kirim"/>
        <input type="hidden" name="alamat" class="input-hide alamat"/>
        <input type="file" name="file_lembar_kerja" class="input-hide file" value="{{ $pembelian->file_lembar_kerja }}"/>
        <input type="hidden" name="keterangan" class="input-hide keterangan"/>
        <input type="hidden" name="sub_total" class="input-hide sub_total"/>
        <input type="hidden" name="diskon_nominal" class="input-hide diskon_nominal"/>
        <input type="hidden" name="biaya_lain_lain" class="input-hide biaya_lain_lain"/>
        <input type="hidden" name="ppn" class="input-hide ppn"/>
        <input type="hidden" name="grand_total" class="input-hide grand_total"/>


        @foreach ($detailPembelian as $k => $detail )
            <input type="hidden" name="productPembelian[{{ $k }}][id]" class="input-hide product-id" value="{{ $detail->id }}"/>
            <input type="hidden" name="productPembelian[{{ $k }}][alias]" class="input-hide product" value="{{ $detail->fid_barang }}"/>
            <input type="hidden" name="productPembelian[{{ $k }}][variasi]" class="input-hide variasi" value="{{ $detail->fid_variasi }}"/>
            <input type="hidden" name="productPembelian[{{ $k }}][keterangan]" class="input-hide keterangan" value="{{ $detail->keterangan }}"/>
            <input type="hidden" name="productPembelian[{{ $k }}][jumlah]" class="input-hide jumlah" value="{{ $detail->jumlah }}"/>
            <input type="hidden" name="productPembelian[{{ $k }}][harga_satuan]" class="input-hide harga_satuan" value="{{ $detail->harga_satuan }}"/>
            <input type="hidden" name="productPembelian[{{ $k }}][total]" class="input-hide total" value="{{ $detail->total }}"/>
        @endforeach


    </form>
</div>
@stop

@section('script')
<script>

   $(()=>{
    $('.Purchase-date.File input').on('click', function(){
        var file = $(this).attr('name');
        var $form = $(`.submit-form form input[name='${file}']`).trigger('click');
        console.log(file);
        console.log($form.val());
    });


    var $table = $('.body-table');
    var idxBarangSales = 0;


    @if(count($detailPembelian) > 0)
    var idxBarangSales = {{ $k }};
    $('body').on('click','.table-form .body-table .icon-plus img', function(){
        idxBarangSales++;
        addrow(idxBarangSales);

    });
    @endif

    function addrow(idx){
        var $content_ = $('.table-form');
        let $form = $('.submit-form form');

        $form.append(`<input type="hidden" name="productPembelian[${idx}][alias]" class="input-hide product"/>`);
        $form.append(`<input type="hidden" name="productPembelian[${idx}][variasi]" class="input-hide variasi"/>`);
        $form.append(`<input type="hidden" name="productPembelian[${idx}][keterangan]" class="input-hide keterangan"/>`);
        $form.append(`<input type="hidden" name="productPembelian[${idx}][jumlah]" class="input-hide jumlah"/>`);
        $form.append(`<input type="hidden" name="productPembelian[${idx}][harga_satuan]" class="input-hide harga_satuan"/>`);
        $form.append(`<input type="hidden" name="productPembelian[${idx}][total]" class="input-hide total"/>`);


        $content_.append(
            `<tr class="body-table" itemid="${idx}" >` +
            `<td class="body-row input-row" data-row="${idx}">`+
                `<div class="part-input alias">`+
                    `<input type="text" class="input-tbl product" data-id="${idx}">`+
                    `<img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="" class="input-icon" data-id="${idx}">`+
                `</div>`+
            '</td>'+
            `<td class="body-row input-row variasi" data-row="${idx}">`+
                `<select name="productPembelian[${idx}][variasi]" data-id="${idx}" class="warna">`+`</select>`+
            `</td>`+
            `<td class="body-row input-row desc" data-row="${idx}">`+
                `<input type="text" name="productPembelian[${idx}][keterangan]" class="input-tbl dsc" data-id="${idx}">`+
            '</td>'+
            `<td class="body-row input-row qty" data-row="${idx}">`+
                `<input type="text" name="productPembelian[${idx}][jumlah]" class="input-tbl qty" data-id="${idx}">`+
            '</td>'+
            `<td class="body-row input-row harga_satuan" data-row="${idx}">`+
                `<input type="text" name="productPembelian[${idx}][harga_satuan]" class="input-tbl unit_price" data-id="${idx}">`+
            '</td>'+
            `<td class="body-row input-row amount" data-row="${idx}">`+
                `<input type="text" name="productPembelian[${idx}][total]" class="input-tbl amount" data-id="${idx}">`+
            '</td>'+
            `<td class="body-row action-btn" data-row="${idx}">`+
                `<div class="icon-plus" data-id="${idx}">`+
                    '<img src="{{ asset('Assets/icon/🦆 icon _plus_.png') }}" alt="" srcset="">'+
                '</div>'+
                `<div class="icon-delete" data-id="${idx}">`+
                    '<img src="{{ asset('Assets/icon/icon _trash_.png') }}" alt="" srcset="">'+
                '</div>'+
            '</td>'+
            '</tr>'
            );
    }


    $('body').on('click','.body-table .icon-delete', function(){
        var $elm = $(this);
        var idx = $elm.attr('data-id');
        var $content_ = $('.table-form');
        var $form = $('.submit-form form');

        var konfirmasi = confirm('yakin menghapus colume?');
        if(konfirmasi){

           $form.find(`input[name="productPembelian[${idx}][alias]"]`).remove();
           $form.find(`input[name="productPembelian[${idx}][variasi]"]`).remove();
           $form.find(`input[name="productPembelian[${idx}][keterangan]"]`).remove();
           $form.find(`input[name="productPembelian[${idx}][jumlah]"]`).remove();
           $form.find(`input[name="productPembelian[${idx}][harga_satuan]"]`).remove();
           $form.find(`input[name="productPembelian[${idx}][total]"]`).remove();

            $content_.find(`.body-table[itemid="${idx}"]`).remove();
        }
    });

    $('body').on('click','.input-icon', function(e){
        e.stopPropagation();
        e.preventDefault();
        var $elm = $(this);
        var xid = $elm.attr('data-id');
        var $product = $('.card-create-customer.alias-Product');
        var $tbl = $('.tbl-product');
        $tbl.attr('data-xid', xid);
        console.log('xid click alias:', xid);

        $('.container-popup-card-product').removeClass('close-hide').addClass('show');
        $product.removeClass('close-hide').addClass('show').attr('data-xid', xid);
        e.stopPropagation();
        e.preventDefault();

        // coding yang didalam sini aku take out jadi global
        // kalau masih di dalam sini , handler tersebut akan diattach setiap .product di klik , sehingga rawan duplicat
    })

    $('body').on('click', `.tbl-product .body-table .selection-check`, function(e){
        var $elm = $(this);
        $(`.tbl-product .body-table .selection-check`).prop('checked', false); // untuk uncek semua checkbox

        if($elm.prop('checked')){

        }else{
            $elm.prop('checked', true);
             var id =$elm.attr('data-barang');
             var iditem =$elm.attr('data-item');
             //console.log(id);
             var xid = $('.tbl-product').attr('data-xid');

            //getProduct(iditem, xid);
            //getVariasi(id, xid);

        }
    }).on('click', '.container-popup-card-product .btn-ok', function(e){

        var $elm = $('.tbl-product .body-table .selection-check:checked');
        $elm.prop('checked', true);
         var id = $elm.attr('data-barang');
         var iditem = $elm.attr('data-item');
         //console.log(id);
         var xid = $('.tbl-product').attr('data-xid');
        console.log('data-id ', xid);
        getProduct(iditem, xid);
        getVariasi(id, xid);
         $('.container-popup-card-product').removeClass('show').addClass('close-hide');
    })
    var amount = 0;


    $('body').on('keypress','.form-table .table-form .body-table input.unit_price',function(e){
        var key = e.which;

        if(key == 13){
            var $elm = $(this);
            var  $table = $('.table-form');
            var idx = $elm.attr('data-id');

            console.log(idx);


            var qty =  $table.find(`input.qty[data-id="${idx}"]`).val();
            var hargaSatuan = $table.find(`input.unit_price[data-id="${idx}"]`).val();

            amount = parseInt(qty)  * parseInt(hargaSatuan) ;

            var total = $table.find(`input.amount[data-id="${idx}"]`).val(amount).text(amount);

            console.log(qty, hargaSatuan, amount, total);
        }

        sum(idx);
    });

    function sum(id){
        var subTotal = 0;
        var $row = $('body .form-table .table-form .body-table');
        $row.each(function(){
            var $nilai = $(this);
            var idx = $nilai.attr('itemid');
            //console.log($row);
            console.log(idx);
            var input  = $row.find(`input.amount[data-id="${idx}"]`).text();

            subTotal += parseFloat(input);
            $('.colum-total input.subtotal').val(subTotal).text(subTotal);
            //console.log(parseFloat(subTotal));

        });
    }

    $('.disc, .dis, .jumlah_ppn, .ppn, .lain-lain').on('input', function(){
        var subtotal = $('.colum-total input.subtotal').val();
        var dis = parseFloat($('.colum-total input.dis').val() / 100);
        var ppn = parseFloat($('.colum-total input.jumlah_ppn').val() / 100);
        var lainLain = parseInt($('.colum-total input.lain-lain').val());

        var hasil_diskon = parseInt(subtotal) * dis;
        $('.colum-total input.disc').val(hasil_diskon).text(hasil_diskon);
        var subtotal1 = parseInt(subtotal) - parseInt( hasil_diskon);

        var hasil_ppn  = parseInt(subtotal1) * ppn;
        $('.colum-total input.ppn').val(hasil_ppn).text(hasil_ppn);
        var subtotal2 = parseInt(subtotal1) + parseInt( hasil_ppn);

        var grand_total = parseInt(subtotal2) + lainLain;
        $('.colum-total input.grand_total').val(grand_total).text(grand_total);

        console.log('total', parseFloat(grand_total), subtotal);
    });


    $('.close').on('click', function(){
        $('.container-popup-card-create').removeClass('show').addClass('close-hide');
        $('.card-create-customer.customer').removeClass('show').addClass('close-hide');
    }).on('click', function(){
        $('.container-popup-cd-pembayaran').removeClass('show').addClass('close-hide');
    }).on('click', function(){
        $('.container-popup-card-product').removeClass('show').addClass('close-hide');
        $('.card-create-customer.alias-Product').removeClass('show').addClass('close-hide');
    });

    $('.btn-save-form.pembelian').on('click', function(){
       // PostDatasales();
        dataProductSales()
    });

    function dataProductSales(){
        var $formhead1 = $('.part-head-left');
        var $formhead2 = $('.part-head-right');
        var $footerForm = $('.footer-form');
        var $formtable = $('.form-table .table-form');
        var $row = $formtable.find('.body-table');
        var $form = $('.submit-form form');
        var $formSet = $('.form-card.pembayaran');


        var Suplier = $formhead1.find('.vendor-selection .input-f.supplier option:selected').val();
        var tanggal = $formhead2.find('.Purchase-date.tanggal input').val();
        var tanggalKirim = $formhead2.find('.Purchase-date.pengiriman input').val();
        var alamat = $formhead1.find('.alamat textarea').val();
        var faktur = $formhead2.find('.i-form-sales.noFaktur input').val();
        //var seles = $formhead2.find('.i-form-sales.seles input.admin_id').val();

        var catatan = $footerForm.find('.catatan-pembayaran textarea.keterangan-pembelian').val();
        console.log(catatan);
        var jenisPengiriaman = $footerForm.find('.jenis-pengiriman input[name="jenis_pengiriman"]:checked').val();
        var subtotal = $footerForm.find('.colum-total input.subtotal').val();
        var discount = $footerForm.find('.colum-total input.disc').val();
        var ppn = $footerForm.find('.colum-total input.ppn').val();
        var lainLain = $footerForm.find('.colum-total input.lain-lain').val();
        var GrandTotal = $footerForm.find('.colum-total input.grand_total').val();

        //pembayaran
        var tanggal_pembayaran = $formSet.find('input#date_pembayaran').val();
        var jumlah =  $formSet.find('input.jumlah').val();
        var pembayaran =  $formSet.find('.pembayaran option:selected').val();
        var dsc = $formSet.find('textarea.dsc').val();


        //pembelian
        $form.find(`input.no_faktur[name="faktur"]`).val(faktur);
        $form.find(`input.customer[name="fid_supplier"]`).val(Suplier);
        $form.find(`input.tanggal[name="tanggal"]`).val(tanggal);
        $form.find(`input.tanggal_kirim[name="tanggal_kirim"]`).val(tanggalKirim);
        $form.find(`input.alamat[name="alamat"]`).val(alamat);
        $form.find(`input.keterangan[name="keterangan"]`).val(catatan);
        $form.find(`input.sub_total[name="sub_total"]`).val(subtotal);
        $form.find(`input.diskon_nominal[name="diskon_nominal"]`).val(discount);
        $form.find(`input.biaya_lain_lain[name="biaya_lain_lain"]`).val(lainLain);
        $form.find(`input.ppn[name="ppn"]`).val(ppn);
        $form.find(`input.grand_total[name="grand_total"]`).val(GrandTotal);


        $row.each(function(){
            var $elm = $(this);
            var idx = $elm.attr('itemid');


            var variasi = $elm.find(`.input-row.variasi .warna[name="productPembelian[${idx}][variasi]"] option:selected`).val();
            var desc = $elm.find(`.input-row.desc input.dsc[name="productPembelian[${idx}][keterangan]"]`).val();
            var jumlah = $elm.find(`.input-row.qty input.qty[name="productPembelian[${idx}][jumlah]"]`).val();
            var hargaSatuan = $elm.find(`.input-row.harga_satuan input.unit_price[name="productPembelian[${idx}][harga_satuan]"]`).val();
            var total = $elm.find(`.input-row.amount input.amount[name="productPembelian[${idx}][total]"]`).val();

            $form.find(`input[name="productPembelian[${idx}][alias]"]`).val();
            $form.find(`input[name="productPembelian[${idx}][variasi]"]`).val(variasi);
            $form.find(`input[name="productPembelian[${idx}][keterangan]"]`).val(desc);
            $form.find(`input[name="productPembelian[${idx}][jumlah]"]`).val(jumlah);
            $form.find(`input[name="productPembelian[${idx}][harga_satuan]"]`).val(hargaSatuan);
            $form.find(`input[name="productPembelian[${idx}][total]"]`).val(total);

            console.log(variasi, desc, jumlah, hargaSatuan, total);
            //console.log($form.find(`input[name="productSales[${idx}][total]"]`).val(total));


        });

        $('.submit-form form').submit();

    }
    function getProduct(id, idx){
        var obj ={};
        var $form = $('.form-table');
        //var $table = $form.find('.body-table .body-row .product');
        //var idx = $table.attr('data-id');
        console.log('data-id get alias:', idx);

        obj["_token"] = "{{ csrf_token() }}";
        obj['id'] = id;
        $.ajax({
             url: "{{route('getProduct')}}",
             data: obj,
             method : 'GET',
             success : function(result){
                 console.log("ini xidTb: ", result.data, idx);
                 form(result.data, idx);

             }
         }).fail(function(data){
         console.log(data);
         });
    }

    function getVariasi(idVar,idx){
        console.log('get varian dari id: ', idVar);
        $.ajax({
            url: '{{ route('get-variasi') }}',
            data: {barang : idVar},
            method: 'GET',
            type: 'json',
            success: function(e){
                var $elm = $(`.warna[data-id="${idx}"]`);
               //let idx = $elm.attr('data-id');


                $elm.html('');

                $elm.append("<option value='0'> -- Pilih Varian -- </option>");

                $.each(e, function(key,value){
                    $elm.append("<option value="+value+">"+key+"</option>");
                });
            },
            done: function(){

            }
        });
    }

    function form(data, idx){
        console.log('set to list sales ', data, idx);
        var $form = $('.form-table');
        var $form2 = $('.submit-form form');
        var $table = $form.find('.body-table .body-row .part-input .product');
        if(data){
            $form.data('id', data.id);
            $form.find(`.body-row.input-row .part-input  input.product[data-id="${idx}"]`).val(data.alias);
            $form2.find(`input[name="productPembelian[${idx}][alias]"]`).val(data.id);
        }
    }
   })

</script>
@stop
