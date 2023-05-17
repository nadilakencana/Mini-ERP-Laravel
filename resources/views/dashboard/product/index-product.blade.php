@extends('layoute.latoute')
@section('content')

@include('dashboard.part-lain.popup_createVariant')
<div class="content-dashboard">
    <div class="navigation-tab">
        <div class="nav-tab active" target-panel="panel1" order="1">Product Approve</div>
        <div class="nav-tab" target-panel="panel2" order="2">Product No Approve</div>
        <div class="nav-tab" target-panel="panel3" order="3">Warna/Variant</div>

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
                <div class="search">
                    <div class="box-search" contenteditable>
                        <p>Search</p>
                    </div>
                    <div class="icon-search" id="first" onclick="search()">
                        <img src="{{ asset('Assets/icon/🦆 icon _search_.png') }}" alt="" srcset="">
                    </div>
                </div>

                <div class="button-section-display">

                    <form class="date_search">
                        <div class="tanggal">
                            <input type="date" name="tanggal" id="date">
                        </div>
                        <button type="submit">Cari</button>
                    </form>

                </div>
            </div>
            <div class="table-data">
                @php $no=1; @endphp
                <table id="data-table" class="data">
                   <tr class="header-table">
                        <th class="header-row" >No</th>
                        <th class="header-row" style="width:200px">Kode Barang/Jasa</th>
                        <th class="header-row" style="width:302px">Nama Barang/Jasa</th>
                        <th class="header-row" style="width:177px">Jenis</th>
                        <th class="header-row" style="width:200px">Harga</th>
                        <th class="header-row">Action</th>
                   </tr>
                   @foreach ($product as $barang )
                   <tr class="body-table">
                        <td class="body-row">{{ $no++ }}</td>
                        <td class="body-row">{{ $barang->kode }}</td>
                        <td class="body-row">{{ $barang->nama_barang}}</td>
                        <td class="body-row">{{ $barang->jenis->nama_jenis }}</td>
                        <td class="body-row">Rp. {{number_format( $barang->harga, 2, ',','.')}}</td>
                        {{--  <td class="body-row">{{ $barang->produk_sendiri}}</td>  --}}
                        <td class="body-row">
                            <div class="action-btn">
                                {{--  <div class="btn-approved" idx="{{ $barang->id }}">
                                   Detail
                                </div>  --}}
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

                {{--  <div class="footer-table">
                    <div class="data-total">Showing 1-10 entries</div>
                    <div class="pagination"></div>
                </div>  --}}

            </div>
        </div>
    </div>
    <div class="panel" data-panel="panel2" panel-order="2">
        <div class="header-content">
            <p class="text-tittle">
                Product Need Approved
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
                <div class="search">
                    <div class="box-search" contenteditable>
                        <p>Search</p>
                    </div>
                    <div class="icon-search" id="first" onclick="search()">
                        <img src="{{ asset('Assets/icon/🦆 icon _search_.png') }}" alt="" srcset="">
                    </div>
                </div>

                <div class="button-section-display">

                    <form class="date_search">
                        <div class="tanggal">
                            <input type="date" name="tanggal" id="date">
                        </div>
                        <button type="submit">Cari</button>
                    </form>

                </div>
            </div>
            <div class="table-data">
                @php $no=1; @endphp
                <table id="data-table" class="data">
                   <tr class="header-table">
                        <th class="header-row" >No</th>
                        <th class="header-row" style="width:200px">Kode Barang/Jasa</th>
                        <th class="header-row" style="width:302px">Nama Barang/Jasa</th>
                        <th class="header-row" style="width:81px">Jenis</th>
                        <th class="header-row" style="width:135px">Harga</th>
                        <th class="header-row">Action</th>
                   </tr>
                   @foreach ($product_not_approved as $barang )
                   <tr class="body-table">
                        <td class="body-row">{{ $no++ }}</td>
                        <td class="body-row">{{ $barang->kode }}</td>
                        <td class="body-row">{{ $barang->nama_barang}}</td>
                        <td class="body-row">{{ $barang->jenis->nama_jenis }}</td>
                        <td class="body-row">Rp. {{number_format( $barang->harga, 2, ',','.')}}</td>
                        {{--  <td class="body-row">{{ $barang->produk_sendiri}}</td>  --}}
                        <td class="body-row">
                            <div class="action-btn">
                                @if (Auth()->user()->role_admin->nama_role == 'Marketing')
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
                                @else
                                <div class="btn-approved" idx="{{ $barang->id }}">
                                    Approved
                                </div>
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
                                @endif

                            </div>
                        </td>

                    </tr>
                   @endforeach

                </table>

                {{--  <div class="footer-table">
                    <div class="data-total">Showing 1-10 entries</div>
                    <div class="pagination"></div>
                </div>  --}}

            </div>
        </div>
    </div>
    <div class="panel" data-panel="panel3" panel-order="3">
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
                <div class="search">
                    <div class="box-search second" contenteditable>
                        <p>Search</p>
                    </div>
                    <div class="icon-search" id="second" onclick="search2()">
                        <img src="{{ asset('Assets/icon/🦆 icon _search_.png') }}" alt="" srcset="">
                    </div>
                </div>

                <div class="button-section-display">
                    <form class="date_search">
                        <div class="tanggal">
                            <input type="date" name="tanggal" id="date">
                        </div>
                        <button type="submit">Cari</button>
                    </form>

                </div>
            </div>
            <div class="table-data">
                @php $no=1; @endphp
                <table class="data" id="data-table1" >
                   <tr class="header-table">
                        <th class="header-row" >No</th>
                        <th class="header-row" style="width:451px">Warna / Varian</th>
                        <th class="header-row" style="width:302px">Product</th>
                        <th class="header-row" style="width: 120px">Action</th>
                   </tr>
                   @foreach ( $variasi as $var )
                   <tr class="body-table">
                    <td class="body-row">{{ $no++ }}</td>
                    <td class="body-row">{{ $var->nama_varian }}</td>
                    <td class="body-row">{{ $var->jenis_barang->nama_jenis }}</td>
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

    <div class="submit-form-create" style="display:none;">
        <form class="close-hide form-create" action="{{ route('multy-varian') }}" method="post">
            @csrf

        </form>

    </div>
</div>
@stop

@section('script')
<script>
    $(()=>{
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
            $('.card-create-product.create').addClass('show').removeClass('close-hide');
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

        $('.card-create-product.edit .btn-save-form').on('click', function(){

            postData()
        });

        $('.card-create-product.create .btn-save-form').on('click', function(){

            $('.submit-form-create form').submit();
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
                 form(result.data, result.barangJenis);
                 console.log(result.data, result.barangJenis);
             }
         }).fail(function(data){
         console.log(data);
         });
     }

     function form(data, barangJenis){
         var $formSet = $('.form-card.edit');
         $formSet.data('id', data.id);
         $formSet.find('.col-form-p-input #barang option:selected.old-barang').val(data.fid_jenis_barang).text(barangJenis.nama_jenis);
         $formSet.find('.col-form-p-input.varian input').val(data.nama_varian);

         $('.container-popup-card-variasi').removeClass('close-hide').addClass('show');
         $('.card-create-product.create').addClass('close-hide').removeClass('show');
        $('.card-create-product.edit')
        .removeClass('close-hide')
        .addClass('show')
        .find('.text-tittle').text('Edit Jenis Barang');

     }

     function clearForm(){
         var $formSet = $('.form-card');
         $formSet.removeData('id');
         $formSet.find('.col-form-p-input #barang option:selected').removeData('fid_jenis_barang');
         $formSet.find('.col-form-p-input.varian input').val('');
     }

        function postData(){
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

        $('.btn-approved').on('click', function(){
            var idx = $(this).attr('idx');
            approved(idx)
        });

        function approved(id){

            var url ="{{ route('approved','') }}";
            baseURL = url + '/' + id;
            $.ajax({
                url:baseURL,
                method: 'POST',
                type: 'json',
                //_token : "{{ csrf_token() }}",
                data:{
                //    data:data,
                  _token : "{{ csrf_token() }}"
                },
                success: function(data){
                    console.log(data);
                    window.location.reload();
                },

            }).fail(function(data){

            console.log(data);

        });
        }
</script>
@stop
