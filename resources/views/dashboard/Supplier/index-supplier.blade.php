@extends('layoute.latoute')
@section('content')

@include('dashboard.part-lain.popup_supplier')
<div class="content-dashboard">
    <div class="navigation-tab">
        <div class="nav-tab active" target-panel="panel1" order="1">Supplier</div>
        <div class="nav-tab" target-panel="panel2" order="2">Detail Supplier</div>
    </div>
    <div class="panel active" data-panel="panel1" panel-order="1">
        <div class="header-content">
            <p class="text-tittle">
                Data Supplier
            </p>
            <a href="{{ route('create-supplier') }}">
                <div class="button-create">
                        <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                        <p>New Supplier</p>
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
                        <th class="header-row" style="width:200px">Nama Supplier</th>
                        <th class="header-row" style="width: 411px;">ALamat</th>
                        <th class="header-row" style="width:177px">No Telephone</th>
                        <th class="header-row" style="width: 130px;">Action</th>
                   </tr>
                   @foreach ($suplier as $sp)
                    <tr class="body-table">
                        <td class="body-row">{{ $no++ }}</td>
                        <td class="body-row">{{ $sp->nama_supplier }}</td>
                        <td class="body-row">{{ $sp->alamat }}</td>
                        <td class="body-row">{{ $sp->no_hp }}</td>
                        <td class="body-row">
                            <div class="action-btn">
                                <a href="{{ route('edit-supplier', encrypt($sp->id) ) }}">
                                    <div class="btn-edit">
                                        <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="">
                                    </div>
                                </a>

                                <form action="{{route('hapus-data', ($sp->id))}}" method="POST">
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
    <div class="panel " data-panel="panel2" panel-order="2">
        <div class="header-content">
            <p class="text-tittle">
                Detail Contact Supplier
            </p>
            <a href="#">
                <div class="button-create contact">
                        <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                        <p>New Contact</p>
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
                <table class="data" id="data-table1">
                   <tr class="header-table">
                        <th class="header-row" >No</th>
                        <th class="header-row" style="width:200px">Nama Supplier</th>
                        <th class="header-row" style="width: 411px;">Nama Lengkap</th>
                        <th class="header-row" style="width:177px">Jabatan</th>
                        <th class="header-row" style="width: 130px;">Email</th>
                        <th class="header-row" style="width: 130px;">No Telpon</th>
                        <th class="header-row" style="width: 130px;">Detail</th>
                        <th class="header-row" >Action</th>
                   </tr>
                   @foreach ($detail_contact as $detail )
                   <tr class="body-table">
                        <td class="body-row">{{ $no++ }}</td>
                        <td class="body-row">{{ $detail->suplier->nama_supplier }}</td>
                        <td class="body-row">{{ $detail->nama_lengkap }}</td>
                        <td class="body-row">{{ $detail->jabatan }}</td>
                        <td class="body-row">{{ $detail->email }}</td>
                        <td class="body-row">{{ $detail->no_hp }}</td>
                        <td class="body-row">
                            <div class="btn-detail" data-id="{{ $detail->id }}">
                                Detail
                            </div>
                        </td>
                        <td class="body-row">
                            <div class="action-btn">
                                <div class="btn-edit detail-contect" data-id="{{ $detail->id }}">
                                    <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="">
                                </div>
                                <form action="{{route('hapus-data-detail-contact', ( $detail->id))}}" method="POST">
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
    $('.nav-tab').on('click', function(e) {
        var target = $(this).attr('target-panel');
        $('.nav-tab').removeClass('active');
        $(this).addClass('active');

        $('.panel').hide();
        console.log();
        $(`.panel[data-panel="${target}"]`).show();
    })
    $(()=>{
        $('.button-create.contact ').on('click', function(e){
            $('.container-popup-card-create').removeClass('close-hide').addClass('show');
            $('.card-create-customer.cp-supplier').removeClass('close-hide').addClass('show');
            e.stopPropagation();
            e.preventDefault();
        })

        $('.btn-detail').on('click', function(e){

            e.stopPropagation();
            e.preventDefault();
            var id = $(this).attr('data-id');
            setDetail(id)
        })

        $('.close').on('click', function(){
            $('.container-popup-card-create').removeClass('show').addClass('close-hide');
            $('.card-create-customer.cp-supplier').removeClass('show').addClass('close-hide');
        }).on('click', function(){
            $('.container-popup-card-create').removeClass('show').addClass('close-hide');
            $('.card-create-customer.detail-data.supplier').removeClass('show').addClass('close-hide');
        })

        $('.btn-edit.detail-contect').on('click', function(e){
            e.stopPropagation();
            e.preventDefault();
            var id = $(this).attr('data-id');
            setform(id);

        })

        $('.btn-save-form').on('click', function(){

            postData()
        })

        function setform(id){
            var obj ={};

            obj["_token"] = "{{ csrf_token() }}";
            obj['id'] = id;
            $.ajax({
                 url: "{{route('edit-contact-detail')}}",
                 data: obj,
                 method : 'GET',
                 success : function(result){
                     form(result.data, result.supplier);
                     console.log(result.data, result.supplier);
                 }
             }).fail(function(data){
             console.log(data);
             });
         }

        function setDetail(id){
            var obj ={};

            obj["_token"] = "{{ csrf_token() }}";
            obj['id'] = id;
            $.ajax({
                 url: "{{route('edit-contact-detail')}}",
                 data: obj,
                 method : 'GET',
                 success : function(result){
                    detail(result.data, result.supplier);
                     console.log(result.data, result.supplier);
                 }
             }).fail(function(data){
             console.log(data);
             });
         }

         function form(data, supplier){
             var $formSet = $('.form-card');
             $formSet.data('id', data.id);
             $formSet.find('.col-form-p-input #supplier option:selected.old-suplier').val(data.fid_supplier).text(supplier.nama_supplier);
             $formSet.find('.col-form-p-input.namaLengkap input').val(data.nama_lengkap);
             $formSet.find('.col-form-p-input.jabatan input').val(data.jabatan);
             $formSet.find('.col-form-p-input.departemen input').val(data.departemen);
             $formSet.find('.col-form-p-input.email input').val(data.email);
             $formSet.find('.col-form-p-input.noHp input').val(data.no_hp);

             $('.container-popup-card-create').removeClass('close-hide').addClass('show');
             $('.card-create-customer.cp-supplier')
                .removeClass('close-hide')
                .addClass('show')
                .find('.text-tittle').text('Edit Contact');
         }

         function detail(data, supplier){
            var $cardDetail = $('.card-create-customer.detail-data.supplier');
            $cardDetail.find('.v-data.name-supplier').text(supplier.nama_supplier);
            $cardDetail.find('.v-data.nama-lengkap').text(data.nama_lengkap);
            $cardDetail.find('.v-data.jabatan').text(data.jabatan);
            $cardDetail.find('.v-data.departemen').text(data.departemen);
            $cardDetail.find('.v-data.email').text(data.email);
            $cardDetail.find('.v-data.nohp').text(data.no_hp);

            $('.container-popup-card-create').removeClass('close-hide').addClass('show');
            $('.card-create-customer.detail-data.supplier').removeClass('close-hide').addClass('show');
         }

         function clearForm(){
             var $formSet = $('.form-card');
             $formSet.removeData('id');
             $formSet.find('.col-form-p-input #supplier ').removeData('fid_supplier');
             $formSet.find('.col-form-p-input.namaLengkap input').val('');
             $formSet.find('.col-form-p-input.jabatan input').val('');
             $formSet.find('.col-form-p-input.departemen input').val('');
             $formSet.find('.col-form-p-input.email input').val('');
             $formSet.find('.col-form-p-input.noHp input').val('');
         }

            function postData(){
             var obj = {};
             var $formSet = $('.form-card');
             var id = $formSet.data('id');
             var masterSupplier = $formSet.find('.col-form-p-input #supplier option:selected').attr('value');
             var namaLengkap =  $formSet.find('.col-form-p-input.namaLengkap input').val();
             var jabatan = $formSet.find('.col-form-p-input.jabatan input').val();
             var departement =   $formSet.find('.col-form-p-input.departemen input').val();
             var email =  $formSet.find('.col-form-p-input.email input').val();
             var noHp = $formSet.find('.col-form-p-input.noHp input').val();

             obj['fid_supplier'] = masterSupplier;
             obj['nama_lengkap'] = namaLengkap;
             obj['jabatan'] = jabatan;
             obj['departemen'] = departement;
             obj['email'] = email;
             obj['no_hp'] = noHp;

             obj["_token"] = "{{ csrf_token() }}";
             if(id){
                 obj['id'] = id;
             }
             $.ajax({
                 url: "{{route('upload-detail-contact')}}",
                 data: obj,
                 method : 'POST',
                 success : function(result){
                     console.log('success', result);
                     clearForm();
                     $('.container-popup-card-create').removeClass('show').addClass('close-hide');
                     $('.card-create-customer.cp-supplier').removeClass('show').addClass('close-hide');
                     window.location.reload();
                 }
             }).fail(function(data){
                console.log(data);
             });
            }
    })

</script>
@stop
