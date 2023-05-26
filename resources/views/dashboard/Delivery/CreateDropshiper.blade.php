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
                <input type="text" name="customer" class="i-form customer" value="{{  $detailSj->customer  }}" >
            </div>
            <div class="alamat">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="" cols="25" rows="4">{{ $detailSj->alamat }}</textarea>
            </div>
        </div>
        <div class="part-head-right">
            <div class="Purchase-date tanggal">
                <label for="date-purchase">Tanggal Surat Jalan</label>
                <input type="date" name="tanggal_sj" id="sales_date">
            </div>
            <div class="Purchase-date pengiriman">
                <label for="date-purchase">Tanggal Kirim</label>
                <input type="date" name="tanggal_kirim" id="sales_date">
            </div>
            <div class="i-form-sales noSj">
                <label for="nofaktur">No Surat Jalan</label>
                <input type="text" name="no_surat_jalan" class="i-form noSj" value="{{  $getNoSj }}">
            </div>
            <div class="i-form-sales noFaktur">
                <label for="nofaktur">No Faktur</label>
                <input type="text" name="no_faktur" class="i-form nofaktur" value="{{  $detailSj->SO->no_faktur }}" disabled>
            </div>
            <div class="i-form-sales seles">
                <label for="nofaktur">Sales</label>
                <input type="text"  class="i-form sales" value="{{ Auth()->user()->nama }}" disabled>
                <input type="hidden" name="fid_user" class="i-form admin_id" value="{{ Auth()->user()->id }}" disabled>
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
                 <th class="header-row" style="display:none"></th>
            </tr>

            @foreach ( $detailBarang as $k => $item )
            <tr class="body-table" itemid="{{ $k }}">
                <td class="body-row input-row" data-row="{{ $k }}">
                    <div class="part-input alias">
                        <input type="text" class="input-tbl product" data-id="{{ $k }}" value="{{ $item->AliasBarang->alias }}">
                        <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="" class="input-icon" data-id="{{ $k }}">
                    </div>
                 </td>
                 <td class="body-row input-row variasi" data-row="{{ $k }}">
                    <select name= "itemPengiriman[{{ $k }}][variasi]" data-id="{{ $k }}" class="warna">
                       <option value="{{ $item->fid_varian }}" selected>{{ $item->Varian->nama_varian }}</option>
                       {{--  @foreach ($detailPenjualan->variasi  as $variasi )
                       <option value="{{ $variasi->id }}">{{ $variasi->nama_varian }}</option>
                       @endforeach  --}}
                    </select>
                </td>
                 <td class="body-row input-row desc" data-row="{{ $k }}">
                    <input type="text" name="itemPengiriman[{{ $k }}][keterangan]"  class="input-tbl dsc" data-id="{{ $k }}" value="{{ $item->keterangan }}">
                 </td>
                 <td class="body-row input-row qty" data-row="{{ $k }}">
                    <input type="text" name="itemPengiriman[{{ $k }}][jumlah]" class="input-tbl qty" data-id="{{ $k }}" value="{{ $item->jumlah }}">
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
                        <textarea class="keterangan-pembelian" name="keterangan" id="" cols="40" rows="5" value="" ></textarea>

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
                    <div class="pengiriman">
                        <input type="radio" name="jenis_pengiriman" id="" value="Dropshiper">
                        <label for="">Dropshiper</label>

                    </div>
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
    <form class="hidden" action="{{route('postData-SuratJalan', encrypt($idx->id))}}" method="POST"  enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="no_surat_jalan" class="input-hide nosj"/>
        <input type="hidden" name="tanggal_sj" class="input-hide tanggal_sj"/>
        <input type="hidden" name="tanggal_kirim" class="input-hide tanggal_kirim"/>
        <input type="hidden" name="tipe" class="input-hide tipe"/>
        <input type="hidden" name="alamat" class="input-hide alamat"/>
        <input type="hidden" name="keterangan" class="input-hide keterangan"/>
        <input type="hidden" name="customer" class="input-hide customer-delivery"/>
        <input type="hidden" name="jenis_surat_jalan" class="input-hide jenis-surat"/>

        {{--  list pengiriman  --}}
        @foreach ( $detailBarang as $k => $item )
        <input type="hidden" name="itemPengiriman[{{ $k }}][alias]" class="input-hide product-delivery" value="{{ $item ->fid_barang}}"/>
        <input type="hidden" name="itemPengiriman[{{ $k }}][variasi]" class="input-hide variasi-delivery" value="{{ $item ->fid_varian}}"/>
        <input type="hidden" name="itemPengiriman[{{ $k }}][keterangan]" class="input-hide keterangan-delivery" value="{{ $item ->keterangan}}"/>
        <input type="hidden" name="itemPengiriman[{{ $k }}][jumlah]" class="input-hide qty-delivery" value="{{ $item ->jumlah}}"/>
        @endforeach


    </form>
</div>
@stop
@section('script')
<script>

    $(()=>{



        $('.close').on('click', function(){
            $('.container-popup-card-create').removeClass('show').addClass('close-hide');
            $('.card-create-customer.customer').removeClass('show').addClass('close-hide');
        }).on('click', function(){
            $('.container-popup-cd-pembayaran').removeClass('show').addClass('close-hide');
        }).on('click', function(){
            $('.container-popup-card-product').removeClass('show').addClass('close-hide');
            $('.card-create-customer.alias-Product').removeClass('show').addClass('close-hide');
        });

        @if(count($detailBarang) > 0)
            var idxBarangSales = {{ $k }};
            $('body').on('click','.table-form .body-table .icon-plus img', function(){
                idxBarangSales++;
                addrow(idxBarangSales);

            });
	    @endif

        function addrow(idx){
            var $content_ = $('.table-form');
            let $form = $('.submit-form form')

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


            $form.find(`input[name="itemPengiriman[${idx}][alias]"]`).remove();
            $form.find(`input[name="itemPengiriman[${idx}][variasi]"]`).remove();
            $form.find(`input[name="itemPengiriman[${idx}][keterangan]"]`).remove();
            $form.find(`input[name="itemPengiriman[${idx}][jumlah]"]`).remove();

                $content_.find(`.body-table[itemid="${idx}"]`).remove();
            }
        });

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
        });

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
        });
        $('.btn-save-form.sales').on('click', function(){
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


            var customer = $formhead1.find('.i-form-sales.Customer .i-form.customer').val();
            var alamat = $formhead1.find('.alamat textarea').val();
            var tanggal = $formhead2.find('.Purchase-date.tanggal input').val();
            var tanggalKirim = $formhead2.find('.Purchase-date.pengiriman input').val();
            var noSJ = $formhead2.find('.i-form-sales.noSj input').val();
            var catatan = $footerForm.find('.catatan-pembayaran textarea.keterangan-pembelian').val();
            console.log(catatan);
            var jenisPengiriaman = $footerForm.find('.jenis-pengiriman input[name="jenis_pengiriman"]:checked').val();


            if( jenisPengiriaman == 'Ambil Sendiri' || jenisPengiriaman == 'Kirim dari toko'){
                var jenisSurat = 'Normal';
            }
            if( jenisPengiriaman == 'Kirim Dari Pabrik') {
                var jenisSurat = 'Pabrik';
            }else{
                var jenisSurat = 'Khusus';
            }

            //detail pengiriman
            $form.find(`input.nosj[name="no_surat_jalan"]`).val(noSJ);
            $form.find(`input.tanggal_sj[name="tanggal_sj"]`).val(tanggal);
            $form.find(`input.tanggal_kirim[name="tanggal_kirim"]`).val(tanggalKirim);
            $form.find(`input.tipe[name="tipe"]`).val(jenisPengiriaman);
            $form.find(`input.alamat[name="alamat"]`).val(alamat);
            $form.find(`input.keterangan[name="keterangan"]`).val(catatan);
            $form.find(`input.customer-delivery[name="customer"]`).val(customer);
            $form.find(`input.delivery[name="pengiriman"]`).val(jenisPengiriaman);
            $form.find(`input.jenis-surat[name="jenis_surat_jalan"]`).val(jenisSurat);

            $row.each(function(){
                var $elm = $(this);
                var idx = $elm.attr('itemid');

                var variasi = $elm.find(`.input-row.variasi .warna[name="itemPengiriman[${idx}][variasi]"] option:selected`).val();
                var desc = $elm.find(`.input-row.desc input.dsc[name="itemPengiriman[${idx}][keterangan]"]`).val();
                var jumlah = $elm.find(`.input-row.qty input.qty[name="itemPengiriman[${idx}][jumlah]"]`).val();

                $form.find(`input[name="itemPengiriman[${idx}][alias]"]`).val();
                $form.find(`input[name="itemPengiriman[${idx}][jumlah]"]`).val(jumlah);
                $form.find(`input[name="itemPengiriman[${idx}][variasi]"]`).val(variasi);
                $form.find(`input[name="itemPengiriman[${idx}][keterangan]"]`).val(desc);

                console.log(variasi, desc, jumlah );


            });

            $('.submit-form form').submit();

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
                $form2.find(`input[name="itemPengiriman[${idx}][alias]"]`).val(data.id);
            }
        }

    })

</script>
@stop
