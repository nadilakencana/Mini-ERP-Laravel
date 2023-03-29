@extends('layoute.latoute')
@section('content')

@include('dashboard.part-lain.popUp_product')
<div class="content-dashboard">
    <div class="header-content">
            <p class="text-tittle">
                Alias Product
            </p>
            <a href="#">
                <div class="button-create alias">
                        <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                        <p>New Alias</p>
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
                <div class="icon-search">
                    <img src="{{ asset('Assets/icon/🦆 icon _search_.png') }}" alt="" srcset="">
                </div>
            </div>

            <div class="button-section-display">
                {{--  <div class="btn-import">
                    <img src="{{ asset('Assets/icon/🦆 icon _cloud download_.png') }}" alt="">
                    <p>Import</p>
                </div>
                <div class="btn-export">
                    <img src="{{ asset('Assets/icon/🦆 icon _account logout_.png') }}" alt="">
                    <p>Export</p>
                </div>  --}}
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
                <table id="data-table">
                   <tr class="header-table">
                        <th class="header-row" >No</th>
                        <th class="header-row" style="width:200px">Kode Barang/Jasa</th>
                        <th class="header-row" style="width:302px">Nama Barang/Jasa</th>
                        <th class="header-row" style="width:177px">Alias</th>
                        <th class="header-row" style="width:234px">Group</th>
                        <th class="header-row" style="width:200px">Action</th>
                   </tr>
                   @foreach ($alias as $barang)
                   <tr class="body-table">
                    <td class="body-row">{{ $no++ }}</td>
                    <td class="body-row"><a href="#">{{ $barang->barang->kode }}</a></td>
                    <td class="body-row">{{ $barang->barang->nama_barang }}</td>
                    <td class="body-row">{{ $barang->alias}}</td>
                    <td class="body-row">{{ $barang->group->nama_toko }}</td>
                    <td class="body-row">
                        <div class="action-btn">
                            <div class="btn-edit" data-id="{{ $barang->id }}">
                                <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="">
                            </div>
                            <form action="{{route('delete-data-alias', ($barang->id))}}" method="POST">
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
@stop

@section('script')
<script>
 $(()=>{
    $('.button-create.alias').on('click', function(){
        $('.container-popup-card-product').removeClass('close-hide').addClass('show');
        $('.card-create-customer.alias-product').removeClass('close-hide').addClass('show');
        e.stopPropagation();
        e.preventDefault();
    })

    $('.close').on('click', function(){
        $('.container-popup-card-product').removeClass('show').addClass('close-hide');
        $('.card-create-customer.alias-product').removeClass('show').addClass('close-hide');
    })

    $('.btn-edit').on('click', function(e){
        e.stopPropagation();
        e.preventDefault();
        var id = $(this).attr('data-id');
        setform(id);

    })

    $('.button-create.jenis').on('click', function(){
        $('.container-popup-card-product').removeClass('close-hide').addClass('show');
        $('.card-create-customer.jenis-product').removeClass('close-hide').addClass('show');
        e.stopPropagation();
        e.preventDefault();
    })

    $('.close').on('click', function(){
        $('.container-popup-card-product').removeClass('show').addClass('close-hide');
        $('.card-create-customer.jenis-product').removeClass('show').addClass('close-hide');
    })

    $('.btn-save-form').on('click', function(){

        postData()
    })




 function setform(id){
    var obj ={};

    obj["_token"] = "{{ csrf_token() }}";
    obj['id'] = id;
    $.ajax({
         url: "{{route('edit-data-alias')}}",
         data: obj,
         method : 'GET',
         success : function(result){
             form(result.data, result.barang, result.group);
             console.log(result.data, result.barang, result.group);
         }
     }).fail(function(data){
     console.log(data);
     });
 }

 function form(data, barang, group){
     var $formSet = $('.form-card');
     $formSet.data('id', data.id);
     $formSet.find('.col-form-p-input #barang option:selected.old-barang').val(data.fid_barang).text(barang.nama_barang);
     $formSet.find('.col-form-p-input #group option:selected.old-group').val(data.fid_group).text(group.nama_toko);
     $formSet.find('.col-form-p-input.alias input').val(data.alias);

     $('.container-popup-card-product').removeClass('close-hide').addClass('show');
     $('.card-create-customer.alias-product')
        .removeClass('close-hide')
        .addClass('show')
        .find('.text-tittle').text('Edit Alias Barang');
 }

 function clearForm(){
     var $formSet = $('.form-card');
     $formSet.removeData('id');
     $formSet.find('.col-form-p-input #barang ').removeData('fid_barang');
     $formSet.find('.col-form-p-input #group').removeData('fid_group');
     $formSet.find('.col-form-p-input.alias input').val('');
 }

    function postData(){
     var obj = {};
     var $formSet = $('.form-card');
     var id = $formSet.data('id');
     var masterBarang = $formSet.find('.col-form-p-input #barang option:selected').attr('value');
     var masterGroup = $formSet.find('.col-form-p-input #group option:selected').attr('value');
     var alias = $formSet.find('.col-form-p-input.alias input').val();

     obj['fid_barang'] = masterBarang;
     obj['fid_group'] = masterGroup;
     obj['alias'] = alias;

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
             clearForm();
             $('.container-popup-card-product').removeClass('show').addClass('close-hide');
             $('.card-create-customer.alias-product').removeClass('show').addClass('close-hide');
             window.location.reload();
         }
     }).fail(function(data){
        console.log(data);
     });
    }
})


</script>
@stop
