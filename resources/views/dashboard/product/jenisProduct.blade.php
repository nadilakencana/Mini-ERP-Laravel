@extends('layoute.latoute')
@section('content')

@include('dashboard.part-lain.popUp_product')
<div class="content-dashboard">
    <div class="header-content">
            <p class="text-tittle">
                Jenis Product
            </p>
            <a href="#">
                <div class="button-create jenis">
                        <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                        <p>New Jenis</p>
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
                        <th class="header-row" style="width:477px">Jenis Product</th>
                        <th class="header-row" style="width:414px">Action</th>
                   </tr>
                   @foreach ($jenis_barang as $jb )
                   <tr class="body-table">
                    <td class="body-row">{{ $no++ }}</td>
                    <td class="body-row">{{ $jb->nama_jenis }}</td>
                    <td class="body-row">
                        <div class="action-btn">
                            <div class="btn-edit" data-id="{{ $jb->id }}">
                                <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="">
                            </div>
                            <form action="{{route('deleteJenis', ($jb->id))}}" method="POST">
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
            //e.stopPropagation();
            //e.preventDefault();
            postData()
        })

     })



     function setform(id){
        var obj ={};

        obj["_token"] = "{{ csrf_token() }}";
        obj['id'] = id;
        $.ajax({
             url: "{{route('editDataJenis')}}",
             data: obj,
             method : 'GET',
             success : function(result){
                 form(result.data);
                 //console.log(data);
             }
         }).fail(function(data){
         console.log(data);
         });
     }

     function form(data){
         var $formSet = $('.form-card');
         $formSet.data('id', data.id);
         $formSet.find('.col-form-p-input.jenis input').val(data.nama_jenis);

         $('.container-popup-card-product').removeClass('close-hide').addClass('show');
         $('.card-create-customer.jenis-product')
            .removeClass('close-hide')
            .addClass('show')
            .find('.text-tittle').text('Edit Jenis Barang');
     }

     function clearForm(){
         var $formSet = $('.form-card');
         $formSet.removeData('id');
         $formSet.find('.col-form-p-input.jenis input').val('');
     }

        function postData(){
         var obj = {};
         var $formSet = $('.form-card');
         var id = $formSet.data('id');
         var jenis = $formSet.find('.col-form-p-input.jenis input').val();

         obj['nama_jenis'] = jenis;

         obj["_token"] = "{{ csrf_token() }}";
         if(id){
             obj['id'] = id;
         }
         $.ajax({
             url: "{{route('updateDataJenis')}}",
             data: obj,
             method : 'POST',
             success : function(result){
                 console.log('success', result);
                 clearForm();
                 $('.container-popup-card-create').removeClass('show').addClass('close-hide');
                 $('.card-create-customer.jenis-product').removeClass('show').addClass('close-hide');
                 window.location.reload();
             }
         }).fail(function(data){
            console.log(data);
         });
        }

</script>
@stop
