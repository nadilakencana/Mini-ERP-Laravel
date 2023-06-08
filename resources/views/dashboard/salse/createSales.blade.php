@extends('layoute.latoute')
@section('content')
{{--  card-content  --}}
{{--  @include('dashboard.part-lain.popUp-SJ')  --}}
@include('dashboard.part-lain.popUp_Create_customer')
@include('dashboard.part-lain.popup_createVariant')
{{--  @include('dashboard.part-lain.popUp_pembayaran')  --}}
@include('dashboard.part-lain.popUp_product')

<div class="card-content-display">
    <div class="header-display">
        <p class="text-tittle">
          New Sales
        </p>
    </div>
    <div class="head">
        <div class="part-head-left">
            <div class="vendor-selection customer">
                <label for="vendor">Customer</label>
                <div class="select-c">
                    <select class="input-f customer @error('fid_customer') is-invalid @enderror " name="fid_customer" id="customer" >
                        <option class="old-customer" value="" selected>
                            Pilih Name Customer
                        </option>
                        @foreach( $customer  as $cs)
                            @if (old('fid_customer') == $cs->id)
                            <option value="{{$cs->id }}" selected>
                                {{ $cs->nama_customer }}
                            </option>
                            @else
                            <option value="{{ $cs->id }}">
                                {{$cs->nama_customer}}
                            </option>
                            @endif
                        @endforeach
                    </select>
                    @error('fid_customer')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div class="btn-customer">...</div>
                </div>
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


{{--  popup product   --}}
<div class="container-popup-card-product alias close-hide">
    <div class="card-position ">
        <div class="card-create-customer alias-Product-so close-hide" style="width: 885px;">
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
    <form class="hidden" action="{{route('postDataSales')}}" method="POST"  enctype="multipart/form-data">
        @csrf

        {{--  //tb penjualan  --}}
        <input type="hidden" name="no_faktur" class="input-hide no_faktur"/>
        <input type="hidden" name="fid_customer" class="input-hide customer"/>
        <input type="hidden" name="tanggal" class="input-hide tanggal"/>
        <input type="hidden" name="tanggal_kirim" class="input-hide tanggal_kirim"/>
        <input type="hidden" name="jenis_pengiriman" class="input-hide jenis_pengiriman"/>
        <input type="hidden" name="keterangan" class="input-hide keterangan"/>
        <input type="hidden" name="sub_total" class="input-hide sub_total"/>
        <input type="hidden" name="diskon_nominal" class="input-hide diskon_nominal"/>
        <input type="hidden" name="biaya_lain_lain" class="input-hide biaya_lain_lain"/>
        <input type="hidden" name="ppn" class="input-hide ppn"/>
        <input type="hidden" name="grand_total" class="input-hide grand_total"/>


        {{--  //product  --}}
        <input type="hidden" name="productSales[0][alias]" class="input-hide product"/>
        <input type="hidden" name="productSales[0][variasi]" class="input-hide variasi"/>
        <input type="hidden" name="productSales[0][keterangan]" class="input-hide keterangan"/>
        <input type="hidden" name="productSales[0][jumlah]" class="input-hide jumlah"/>
        <input type="hidden" name="productSales[0][harga_satuan]" class="input-hide harga_satuan"/>
        <input type="hidden" name="productSales[0][total]" class="input-hide total"/>

        {{--  //tb detail pengiriman  --}}
        <input type="hidden" name="tanggal_sj" class="input-hide tanggal_sj"/>
        <input type="hidden" name="tanggal_kirim" class="input-hide tanggal_kirim"/>
        <input type="hidden" name="tipe" class="input-hide tipe"/>
        <input type="hidden" name="alamat" class="input-hide alamat"/>
        <input type="hidden" name="keterangan" class="input-hide keterangan"/>
        <input type="hidden" name="customer" class="input-hide customer-delivery"/>
        <input type="hidden" name="pengiriman" class="input-hide delivery"/>
        //<input type="hidden" name="jenis_surat_jalan" class="input-hide jenis-surat-delivery"/>

        {{--  list pengiriman  --}}
        <input type="hidden" name="itemPengiriman[0][alias]" class="input-hide product-delivery"/>
        <input type="hidden" name="itemPengiriman[0][variasi]" class="input-hide variasi-delivery"/>
        <input type="hidden" name="itemPengiriman[0][keterangan]" class="input-hide keterangan-delivery"/>
        <input type="hidden" name="itemPengiriman[0][jumlah]" class="input-hide qty-delivery"/>


    </form>
</div>

<div class="submit-form-create" style="display:none;">
    <form class="close-hide form-create" action="{{ route('multy-varian') }}" method="post">
        @csrf

    </form>

</div>




@stop
@section('script')
<script>
    $(()=>{
        $('#checkbox').on('click',function(){
            var $elm = $(this);
            $('#checkbox').prop('checked', true)
            if($elm.prop('checked')){
                $elm.val(1);
           }else{
               $elm.val(0);
           }
            console.log($(this).val());
       });


        $('#checkbox.alias').on('click',function(){
            var $elm = $(this);
            $('#checkbox.alias').prop('checked', true);
                if($elm.prop('checked')){
                    $('button.btn-save-form').on('click', function(){
                        $('.card-create-customer.product').addClass('close-hide').removeClass('show');
                        $('.card-create-customer.alias-product').removeClass('close-hide').addClass('show');
                    });

                }
            //console.log($(this).val());
       });



        var $table = $('.body-table');
        var idxBarangSales = 0;



        $('body').on('click','.table-form .body-table .icon-plus img', function(){
            idxBarangSales++;
            addrow(idxBarangSales);

        });

        $('.btn-save-form.customer').on('click', function(){

            postData()
        });

        function addrow(idx){
            var $content_ = $('.table-form');
            let $form = $('.submit-form form')

            $form.append(`<input type="hidden" name="productSales[${idx}][alias]" class="input-hide product"/>`);
            $form.append(`<input type="hidden" name="productSales[${idx}][variasi]" class="input-hide variasi"/>`);
            $form.append(`<input type="hidden" name="productSales[${idx}][keterangan]" class="input-hide keterangan"/>`);
            $form.append(`<input type="hidden" name="productSales[${idx}][jumlah]" class="input-hide jumlah"/>`);
            $form.append(`<input type="hidden" name="productSales[${idx}][harga_satuan]" class="input-hide harga_satuan"/>`);
            $form.append(`<input type="hidden" name="productSales[${idx}][total]" class="input-hide total"/>`);

            $form.append(`<input type="hidden" name="itemPengiriman[${idx}][alias]" class="input-hide product-delivery"/>`);
            $form.append(`<input type="hidden" name="itemPengiriman[${idx}][variasi]" class="input-hide variasi-delivery"/>`);
            $form.append(`<input type="hidden" name="itemPengiriman[${idx}][keterangan]" class="input-hide keterangan-delivery"/>`);
            $form.append(`<input type="hidden" name="itemPengiriman[${idx}][jumlah]" class="input-hide qty-delivery"/>`);
            

			$content_.append(
                `<tr class="body-table" itemid="${idx}" >` +
                `<td class="body-row input-row" data-row="${idx}">`+
                    `<div class="part-input alias">`+
                        `<input type="text" class="input-tbl product" data-id="${idx}">`+
                        `<img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="" class="input-icon" data-id="${idx}">`+
                    `</div>`+
                '</td>'+
                `<td class="body-row input-row variasi" data-row="${idx}">`+
                    `<select name="productSales[${idx}][variasi]" data-id="${idx}" class="warna">`+`</select>`+
                `</td>`+
                `<td class="body-row input-row desc" data-row="${idx}">`+
                    `<input type="text" name="productSales[${idx}][keterangan]" class="input-tbl dsc" data-id="${idx}">`+
                '</td>'+
                `<td class="body-row input-row qty" data-row="${idx}">`+
                    `<input type="text" name="productSales[${idx}][jumlah]" class="input-tbl qty" data-id="${idx}">`+
                '</td>'+
                `<td class="body-row input-row harga_satuan" data-row="${idx}">`+
                    `<input type="text" name="productSales[${idx}][harga_satuan]" class="input-tbl unit_price" data-id="${idx}">`+
                '</td>'+
                `<td class="body-row input-row amount" data-row="${idx}">`+
                    `<input type="text" name="productSales[${idx}][total]" class="input-tbl amount" data-id="${idx}">`+
                '</td>'+
                `<td class="body-row action-btn" data-row="${idx}">`+
                    `<div class="icon-plus" data-id="${idx}">`+
                        '<img src="{{ asset('Assets/icon/🦆 icon _plus_.png') }}" alt="" srcset="">'+
                    '</div>'+
                    `<div class="icon-delete" data-id="${idx}">`+
                        '<img src="{{ asset('Assets/icon/icon _trash_.png') }}" alt="" srcset="">'+
                    '</div>'+

                '</td>'+
                '</tr>' );
        }


        $('body').on('click','.body-table .icon-delete', function(){
            var $elm = $(this);
            var idx = $elm.attr('data-id');
            var $content_ = $('.table-form');
            var $form = $('.submit-form form');

            var konfirmasi = confirm('yakin menghapus colume?');
			if(konfirmasi){

               $form.find(`input[name="productSales[${idx}][alias]"]`).remove();
               $form.find(`input[name="productSales[${idx}][variasi]"]`).remove();
               $form.find(`input[name="productSales[${idx}][keterangan]"]`).remove();
               $form.find(`input[name="productSales[${idx}][jumlah]"]`).remove();
               $form.find(`input[name="productSales[${idx}][harga_satuan]"]`).remove();
               $form.find(`input[name="productSales[${idx}][total]"]`).remove();

               $form.find(`input[name="itemPengiriman[${idx}][alias]"]`).remove();
               $form.find(`input[name="itemPengiriman[${idx}][variasi]"]`).remove();
               $form.find(`input[name="itemPengiriman[${idx}][keterangan]"]`).remove();
               $form.find(`input[name="itemPengiriman[${idx}][jumlah]"]`).remove();

                $content_.find(`.body-table[itemid="${idx}"]`).remove();
			}
        });



        $('.p-sj-form ').on('click', function(e){
            $('.container-popup').addClass('show').removeClass('close-hide');
            e.stopPropagation();
            e.preventDefault();

        });


        $('.close-doc').on('click', function(){
            $('.container-popup').removeClass('show').addClass('close-hide');
        });

        $('.btn-customer').on('click', function(e){
            $('.container-popup-card-create').addClass('show').removeClass('close-hide');
            $('.card-create-customer.customer').addClass('show').removeClass('close-hide');
            e.stopPropagation();
            e.preventDefault();

        });

        $('.icon-pembayaran').on('click', function(e){
            $('.container-popup-cd-pembayaran').removeClass('close-hide').addClass('show');
            e.stopPropagation();
            e.preventDefault();
        });


        $('.select-c .input-f.customer').on('click', function(){
            var idx = $(this).children("option:selected").val();
            console.log(idx)

            getdataCustomer(idx);
        })

        var lastTag = [];
		var tagIdx = 0;

        $('#input-tags').selectize({
            items: [],
            persist: false,
            create: function (input) {
              return {
                  value: input,
                  text: input,
              };
            },
            onItemAdd: function(lastVal,elm){
				//console.log('add');
				var $tagElm = $(elm);
				$tagElm.attr('idx', tagIdx);
				tagIdx++;

				addVarian(lastVal, $tagElm);
			},
			onItemRemove: function(lastVal,elm){
				//console.log('remove');
				var $tagElm = $(elm);
				var tIdx = $tagElm.attr('idx');

				removeVarian(lastVal,elm);
			}
          });

        $('.btn-act.varian').on('click', function(e){

            $('.container-popup-card-variasi').addClass('show').removeClass('close-hide');
            $('.card-create-product.create').addClass('show').removeClass('close-hide');
            e.stopPropagation();
            e.preventDefault();
        });
        $('.btn-act.product').on('click', function(e){

            $('.container-popup-card-product').addClass('show').removeClass('close-hide');
            $('.card-create-customer.product').addClass('show').removeClass('close-hide');
            e.stopPropagation();
            e.preventDefault();
        });

        $('.close-create').on('click', function(){
            $('.container-popup-card-variasi').removeClass('show').addClass('close-hide');
            $('.card-create-product').removeClass('variasi-in');
        });
        $('.card-create-product.edit .btn-save-form').on('click', function(){

            postDataVarian()
        });

        $('.card-create-product.create .btn-save-form').on('click', function(){

            $('.submit-form-create form').submit();
        });

        function postDataVarian(){
            var obj = {};
            var $formSet = $('.form-card.edit');
            var id = $formSet.data('id');
            var masterBarang = $formSet.find('.col-form-p-input #barang option:selected').attr('value');
            var Varian = $formSet.find('.col-form-p-input.varian input').val();

            obj['fid_jenis_barang'] = masterBarang;
            obj['nama_varian'] = Varian;
            console.log(obj['nama_varian']);


            obj["_token"] = "{{ csrf_token() }}";
            if(id){
                obj['id'] = id;
            }
            $.ajax({
                url: "{{route('post-varian')}}",
                data: obj,
                method : 'POST',
                success : function(result){
                    console.log('success', result);
                    clearForm();
                    $('.container-popup-card-variasi ').removeClass('show').addClass('close-hide');
                    $('.card-create-product variasi-in').removeClass('show').addClass('close-hide');
                    window.location.reload();
                }
            }).fail(function(data){
               console.log(data);
            });
           }

           function removeVarian(lastVal, $elm){
               var $form = $('.submit-form-create form');
               var idx = $elm.attr('idx');

               $form.find(`input[name="varian[${idx}][nama_varian]"]`).remove();
               $form.find(`input[name="varian[${idx}][fid_jenis_barang]"]`).remove();

           }

           function addVarian(lastVal, $elm){
               var idxBarang = $('.col-form-p-input #barang option:selected.item-barang').attr('value');
               var $form = $('.submit-form-create form');
               var idx = $elm.attr('idx');
               $form.append(`<input name="varian[${idx}][nama_varian]" type="hidden" value="${lastVal}"/>`);
               $form.append(`<input name="varian[${idx}][fid_jenis_barang]" type="hidden" value="${idxBarang}" />`);
           }

        $('body').on('click','.input-icon', function(e){
            e.stopPropagation();
            e.preventDefault();
            var $elm = $(this);
            var xid = $elm.attr('data-id');
            var $product = $('.card-create-customer.alias-Product-so');
            var $tbl = $('.tbl-product');
            $tbl.attr('data-xid', xid);
            console.log('xid click alias:', xid);

            $('.container-popup-card-product.alias').removeClass('close-hide').addClass('show');
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

        $('.btn-save-form.sales').on('click', function(){
           // PostDatasales();
            dataProductSales()
        });

    });

    function dataProductSales(){
        var $formhead1 = $('.part-head-left');
        var $formhead2 = $('.part-head-right');
        var $footerForm = $('.footer-form');
        var $formtable = $('.form-table .table-form');
        var $row = $formtable.find('.body-table');
        var $form = $('.submit-form form');
        var $formSet = $('.form-card.pembayaran');


        var customer = $formhead1.find('.vendor-selection .input-f.customer option:selected').val();
        var nama_customer = $formhead1.find('.vendor-selection .input-f.customer option:selected').text();
        var alamat = $formhead1.find('.alamat textarea').val();
        var tanggal = $formhead2.find('.Purchase-date.tanggal input').val();
        var tanggalKirim = $formhead2.find('.Purchase-date.pengiriman input').val();
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

        //penjualan
        $form.find(`input.no_faktur[name="no_faktur"]`).val(faktur);
        $form.find(`input.customer[name="fid_customer"]`).val(customer);
        $form.find(`input.tanggal[name="tanggal"]`).val(tanggal);
        $form.find(`input.tanggal_kirim[name="tanggal_kirim"]`).val(tanggalKirim);
        $form.find(`input.jenis_pengiriman[name="jenis_pengiriman"]`).val(jenisPengiriaman);
        $form.find(`input.keterangan[name="keterangan"]`).val(catatan);
        $form.find(`input.sub_total[name="sub_total"]`).val(subtotal);
        $form.find(`input.diskon_nominal[name="diskon_nominal"]`).val(discount);
        $form.find(`input.biaya_lain_lain[name="biaya_lain_lain"]`).val(lainLain);
        $form.find(`input.ppn[name="ppn"]`).val(ppn);
        $form.find(`input.grand_total[name="grand_total"]`).val(GrandTotal);

        //detail pengiriman
        $form.find(`input.tanggal_sj[name="tanggal_sj"]`).val(tanggal);
        $form.find(`input.tanggal_kirim[name="tanggal_kirim"]`).val(tanggalKirim);
        $form.find(`input.tipe[name="tipe"]`).val(jenisPengiriaman);
        $form.find(`input.alamat[name="alamat"]`).val(alamat);
        $form.find(`input.keterangan[name="keterangan"]`).val(catatan);
        $form.find(`input.customer-delivery[name="customer"]`).val(nama_customer);
        $form.find(`input.delivery[name="pengiriman"]`).val(jenisPengiriaman);
        //$form.find(`input.jenis-surat-delivery[name="jenis_surat_jalan"]`).val(catatan);

        $row.each(function(){
            var $elm = $(this);
            var idx = $elm.attr('itemid');


            var variasi = $elm.find(`.input-row.variasi .warna[name="productSales[${idx}][variasi]"] option:selected`).val();
            var desc = $elm.find(`.input-row.desc input.dsc[name="productSales[${idx}][keterangan]"]`).val();
            var jumlah = $elm.find(`.input-row.qty input.qty[name="productSales[${idx}][jumlah]"]`).val();
            var hargaSatuan = $elm.find(`.input-row.harga_satuan input.unit_price[name="productSales[${idx}][harga_satuan]"]`).val();
            var total = $elm.find(`.input-row.amount input.amount[name="productSales[${idx}][total]"]`).val();

            $form.find(`input[name="productSales[${idx}][alias]"]`).val();
            $form.find(`input[name="productSales[${idx}][variasi]"]`).val(variasi);
            $form.find(`input[name="productSales[${idx}][keterangan]"]`).val(desc);
            $form.find(`input[name="productSales[${idx}][jumlah]"]`).val(jumlah);
            $form.find(`input[name="productSales[${idx}][harga_satuan]"]`).val(hargaSatuan);
            $form.find(`input[name="productSales[${idx}][total]"]`).val(total);

            $form.find(`input[name="itemPengiriman[${idx}][alias]"]`).val();
            $form.find(`input[name="itemPengiriman[${idx}][jumlah]"]`).val(jumlah);
            $form.find(`input[name="itemPengiriman[${idx}][variasi]"]`).val(variasi);
            $form.find(`input[name="itemPengiriman[${idx}][keterangan]"]`).val(desc);

            console.log(variasi, desc, jumlah, hargaSatuan, total);
            //console.log($form.find(`input[name="productSales[${idx}][total]"]`).val(total));


        });

        $('.submit-form form').submit();

    }

    //master product

    $('.master-barang').on('click', function(){
        postDataMasterBarang();
    })

    function clearFormMaster(){
        var $formSet = $('.form-card');
        $formSet.removeData('id');
        $formSet.find('.col-form-p-input.kode input').val('');
        $formSet.find('.col-form-p-input.nama-barang input').val('');
        $formSet.find('.col-form-p-input .jenis ').removeData('fid_jenis_barang');
        $formSet.find('.col-form-p-input.harga input').val('');
        $formSet.find('.col-form-p-input.product-sendiri input').val('');
    }

    function postDataMasterBarang(){
        var obj = {};
        var $formSet = $('.form-card');
        var id = $formSet.data('id');
        var kode = $formSet.find('.col-form-p-input.kode input').val();
        var nama = $formSet.find('.col-form-p-input.nama-barang input').val();
        var jenis = $formSet.find('.col-form-p-input .jenis option:selected').attr('value');
        var harga = $formSet.find('.col-form-p-input.harga_barang input').val();
        var asal_product = $formSet.find('.col-form-p-input.product-sendiri input').val();

        obj['kode'] = kode;
        obj['nama_barang'] = nama;
        obj['fid_jenis_barang'] = jenis;
        obj['harga'] = harga;
        obj['product_sendiri'] = asal_product;

        //console.log(obj['fid_group']);

        obj["_token"] = "{{ csrf_token() }}";
        if(id){
            obj['id'] = id;
        }
        $.ajax({
            url: "{{route('post-barang-inSales')}}",
            data: obj,
            method : 'POST',
            success : function(result){
                console.log('success', result);
                clearFormMaster();
                $('#checkbox.alias').prop('checked', true);
                if($('#checkbox.alias').prop('checked')){
                        $('.card-create-customer.product').addClass('close-hide').removeClass('show');
                        $('.card-create-customer.alias-product').removeClass('close-hide').addClass('show');
                }else{
                    $('.container-popup-card-product').removeClass('show').addClass('close-hide');
                    $('.card-create-customer.product').removeClass('show').addClass('close-hide');
                }
                //window.location.reload();
            }
        }).fail(function(data){
           console.log(data);
        });
    }

    //alias
    $('.btn-save-form.alias').on('click', function(){

        postDataAlias();
    });

    $('.col-form-p-input.barang #barang').on('click', function(){
        getMasterBarang();
    });

    function getMasterBarang(){
        $.ajax({
            url: '{{ route('masterBarang') }}',
            method: 'GET',
            type: 'json',
            success: function(e){
                var $elm = $(`.col-form-p-input.barang #barang`);
               //let idx = $elm.attr('data-id');
                $elm.html('');

                $elm.append("<option value='0'>  --pilih Master Barang-- </option>");

                $.each(e, function(key,value){
                    $elm.append("<option value="+value+">"+key+"</option>");
                });
            },
            done: function(){

            }
        });
    }
    function clearFormAlias(){
        var $formSet = $('.form-card');
        $formSet.removeData('id');
        $formSet.find('.col-form-p-input #barang ').removeData('fid_barang');
        $formSet.find('.col-form-p-input #group').removeData('fid_group');
        $formSet.find('.col-form-p-input.alias input').val('');
        $formSet.find('.col-form-p-input.harga input').val('');
    }

    function postDataAlias(){
        var obj = {};
        var $formSet = $('.form-card');
        var id = $formSet.data('id');
        var masterBarang = $formSet.find('.col-form-p-input #barang option:selected').attr('value');
        var masterGroup = $formSet.find('.col-form-p-input #group option:selected').attr('value');
        var alias = $formSet.find('.col-form-p-input.alias input').val();
        var harga = $formSet.find('.col-form-p-input.harga input').val();

        obj['fid_barang'] = masterBarang;
        obj['fid_group'] = masterGroup;
        obj['alias'] = alias;
        obj['harga'] = harga;

        console.log(obj['fid_group']);

        obj["_token"] = "{{ csrf_token() }}";
        if(id){
            obj['id'] = id;
        }
        $.ajax({
            url: "{{route('post-data-alias')}}",
            data: obj,
            method : 'POST',
            success : function(result){
                console.log('success', result);
                clearFormAlias();
                $('.container-popup-card-product').removeClass('show').addClass('close-hide');
                $('.card-create-customer.alias-product').removeClass('show').addClass('close-hide');
                window.location.reload();
            }
        }).fail(function(data){
           console.log(data);
        });
    }

    //customer
    function postData(){
        var obj = {};
        var $formSet = $('.form-card');
        var id = $formSet.data('id');
        var Customer = $formSet.find('.col-form-p-input.customer input').val();
        var alamat =  $formSet.find('.col-form-p-input.alamat-cs textarea').val();
        var noHp = $formSet.find('.col-form-p-input.hp input').val();
        var email =  $formSet.find('.col-form-p-input.email input').val();
        var npwp = $formSet.find('.col-form-p-input.npwp input').val();

        obj['nama_customer'] = Customer;
        obj['alamat'] = alamat;
        obj['email'] = email;
        obj['no_hp'] = noHp;
        obj['npwp'] = npwp;

        obj["_token"] = "{{ csrf_token() }}";
        if(id){
            obj['id'] = id;
        }
        $.ajax({
            url: "{{route('post-data-customer-insales')}}",
            data: obj,
            method : 'POST',
            success : function(result){
                console.log('success', result);
                //clearForm();
                $('.container-popup-card-create').removeClass('show').addClass('close-hide');
                $('.card-create-customer.customer').removeClass('show').addClass('close-hide');
                window.location.reload();
            }
        }).fail(function(data){
           console.log(data);
        });
    }

    function getdataCustomer(id){
        var obj = {};
        obj["_token"] = "{{ csrf_token() }}";
        obj['id'] = id;
        $.ajax({
            url: "{{route('getCustomer')}}",
            data: obj,
            method : 'GET',
            success : function(result){
                console.log("ini xidTb: ", result.data);
                formAlamat(result.data);

            }
        }).fail(function(data){
        console.log(data);
        });
    }

    function formAlamat(data){
        var $target = $('.head .part-head-left');
        $target.find('.alamat textarea').val(data.alamat).text(data.alamat);

        console.log($target);
    }

    function getProduct(id, idx){
        var obj ={};
        var $form = $('.form-table');
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
            $form2.find(`input[name="productSales[${idx}][alias]"]`).val(data.id);
            $form2.find(`input[name="itemPengiriman[${idx}][alias]"]`).val(data.id);
        }
    }



</script>
@stop




