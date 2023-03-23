@extends('layoute.latoute')
@section('content')

@include('dashboard.part-lain.popup_createVariant')
<div class="content-dashboard">
    <div class="navigation-tab">
        <div class="nav-tab active" target-panel="panel1" order="1">Product</div>
        <div class="nav-tab" target-panel="panel2" order="2">Warna/Variant</div>

    </div>
    <div class="panel active" data-panel="panel1" panel-order="1">
        <div class="header-content">
            <p class="text-tittle">
                Product
            </p>
            <a href="{{ route('create-product') }}">
                <div class="button-create">
                        <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                        <p>New Product</p>
                </div>
            </a>
        </div>
        {{--  card-content  --}}
        <div class="card-content-display">
            <div class="header-display">
                <div class="box-search">
                    <div class="icon-search">
                        <img src="{{ asset('Assets/icon/🦆 icon _search_.png') }}" alt="" srcset="">
                    </div>
                    <p>Search</p>
                </div>
                <div class="button-section-display">
                    <div class="btn-import">
                        <img src="{{ asset('Assets/icon/🦆 icon _cloud download_.png') }}" alt="">
                        <p>Import</p>
                    </div>
                    <div class="btn-export">
                        <img src="{{ asset('Assets/icon/🦆 icon _account logout_.png') }}" alt="">
                        <p>Export</p>
                    </div>
                    <form action="">
                        <div class="Purchase-date">
                            <input type="date" name="date" id="date_po">
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-data">
                @php $no=1; @endphp
                <table>
                   <tr class="header-table">
                        <th class="header-row" >No</th>
                        <th class="header-row" style="width:200px">Kode Barang/Jasa</th>
                        <th class="header-row" style="width:302px">Nama Barang/Jasa</th>
                        <th class="header-row" style="width:177px">Jenis</th>
                        <th class="header-row" style="width:234px">Status Product</th>
                        <th class="header-row">Action</th>
                   </tr>
                   @foreach ($product as $barang )
                   <tr class="body-table">
                        <td class="body-row">{{ $no++ }}</td>
                        <td class="body-row">{{ $barang->kode }}</td>
                        <td class="body-row">{{ $barang->nama_barang}}</td>
                        <td class="body-row">{{ $barang->jenis->nama_jenis }}</td>
                        <td class="body-row">{{ $barang->produk_sendiri}}</td>
                        <td class="body-row">
                            <div class="action-btn">
                                <a href="{{ route('edit-product', encrypt($barang->id)) }}">
                                    <div class="btn-edit">
                                        <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="">
                                    </div>
                                </a>
                                <form action="{{route('delete-barang', ($barang->id))}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit">
                                        <div class="btn-delete">
                                            <img src="{{ asset('Assets/icon/icon _trash_.png') }}" alt="">
                                        </div>
                                    </button>

                                </form>
                            </div>
                        </td>

                    </tr>
                   @endforeach

                </table>

                <div class="footer-table">
                    <div class="data-total">Showing 1-10 entries</div>
                    <div class="pagination"></div>
                </div>

            </div>
        </div>
    </div>
    <div class="panel" data-panel="panel2" panel-order="2">
        <div class="header-content">
            <p class="text-tittle">
             Warna/Variant
            </p>
            <a href="#">
                <div class="button-create varian-create">
                        <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                        <p>New Variant</p>
                </div>
            </a>
        </div>
        {{--  card-content  --}}
        <div class="card-content-display">
            <div class="header-display">
                <div class="box-search">
                    <div class="icon-search">
                        <img src="{{ asset('Assets/icon/🦆 icon _search_.png') }}" alt="" srcset="">
                    </div>
                    <p>Search</p>
                </div>
                <div class="button-section-display">
                    <div class="btn-import">
                        <img src="{{ asset('Assets/icon/🦆 icon _cloud download_.png') }}" alt="">
                        <p>Import</p>
                    </div>
                    <div class="btn-export">
                        <img src="{{ asset('Assets/icon/🦆 icon _account logout_.png') }}" alt="">
                        <p>Export</p>
                    </div>
                    <form action="">
                        <div class="Purchase-date">
                            <input type="date" name="date" id="date_po">
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-data">
                @php $no=1; @endphp
                <table>
                   <tr class="header-table">
                        <th class="header-row" >No</th>
                        <th class="header-row" style="width:451px">Warna / Varian</th>
                        <th class="header-row" style="width:302px">Product</th>
                        <th class="header-row" style="width: 120px">Action</th>
                   </tr>
                   @foreach ( $variasi as $var )
                   <tr class="body-table">
                    <td class="body-row">{{ $no++ }}</td>
                    <td class="body-row"><a href="#">{{ $var->nama_varian }}</a></td>
                    <td class="body-row">{{ $var->barang->nama_barang }}</td>
                    <td class="body-row">
                        <div class="action-btn">
                            <div class="btn-edit varian" data-id="{{ $var->id }}">
                                <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="">
                            </div>
                            <form action="{{route('delete-varian', ($var->id))}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit">
                                    <div class="btn-delete">
                                        <img src="{{ asset('Assets/icon/icon _trash_.png') }}" alt="">
                                    </div>
                                </button>

                            </form>
                        </div>

                    </td>
               </tr>
                   @endforeach

                </table>

                <div class="footer-table">
                    <div class="data-total">Showing 1-10 entries</div>
                    <div class="pagination"></div>
                </div>

            </div>
        </div>
    </div>

</div>
@stop

@section('script')
<script>
    $(()=>{
        $('.nav-tab').on('click', function(e) {
            var target = $(this).attr('target-panel');
            $('.nav-tab').removeClass('active');
            $(this).addClass('active');

            $('.panel').hide();
            console.log();
            $(`.panel[data-panel="${target}"]`).show();
        })

        $('.varian-create').on('click', function(){

            $('.container-popup-card-variasi').addClass('show').removeClass('close-hide');
            $('.card-create-product').addClass('show').removeClass('close-hide');
            e.stopPropagation();
            e.preventDefault();
        })
        $('.close-create').on('click', function(){
            $('.container-popup-card-variasi').removeClass('show').addClass('close-hide');
            $('.card-create-product').removeClass('variasi-in');
        });

        $('.btn-edit.varian').on('click', function(e){
            e.stopPropagation();
            e.preventDefault();
            var id = $(this).attr('data-id');
            setform(id);

        })

        $('.btn-save-form').on('click', function(){

            postData()
        })

    })


    function setform(id){
        var obj ={};

        obj["_token"] = "{{ csrf_token() }}";
        obj['id'] = id;
        $.ajax({
             url: "{{route('edit-varian')}}",
             data: obj,
             method : 'GET',
             success : function(result){
                 form(result.data, result.barang);
                 console.log(result.data, result.barang);
             }
         }).fail(function(data){
         console.log(data);
         });
     }

     function form(data, barang){
         var $formSet = $('.form-card');
         $formSet.data('id', data.id);
         $formSet.find('.col-form-p-input #barang option:selected.old-barang').val(data.fid_barang).text(barang.nama_barang);
         $formSet.find('.col-form-p-input.varian input').val(data.nama_varian);

         $('.container-popup-card-variasi').removeClass('close-hide').addClass('show');
        $('.card-create-product')
        .removeClass('close-hide')
        .addClass('show')
        .find('.text-tittle').text('Edit Jenis Barang');

     }

     function clearForm(){
         var $formSet = $('.form-card');
         $formSet.removeData('id');
         $formSet.find('.col-form-p-input #barang option:selected').removeData('fid_barang');
         $formSet.find('.col-form-p-input.varian input').val('');
     }

        function postData(){
         var obj = {};
         var $formSet = $('.form-card');
         var id = $formSet.data('id');
         var masterBarang = $formSet.find('.col-form-p-input #barang option:selected').attr('value');
         var Varian = $formSet.find('.col-form-p-input.varian input').val();

         obj['fid_barang'] = masterBarang;
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
</script>
@stop
