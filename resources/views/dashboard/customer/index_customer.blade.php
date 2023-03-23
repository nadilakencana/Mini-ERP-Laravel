@extends('layoute.latoute')
@section('content')

@include('dashboard.part-lain.popUp_Create_customer')
<div class="content-dashboard">
    <div class="navigation-tab">
        <div class="nav-tab active" target-panel="panel1" order="1">Customer</div>
        <div class="nav-tab" target-panel="panel2" order="2">Detail Contact</div>
    </div>
    <div class="panel active" data-panel="panel1" panel-order="1">
        <div class="header-content">
            <p class="text-tittle">
                Data Customer
            </p>
            <a href="{{ route('customer-create') }}">
                <div class="button-create">
                        <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                        <p>New Customer</p>
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
                        <th class="header-row" style="width:200px">Nama Customer</th>
                        <th class="header-row" style="width: 411px;">ALamat</th>
                        <th class="header-row" style="width:177px">No Telephone</th>
                        <th class="header-row" style="width: 130px;">Action</th>
                </tr>
                @foreach ($customer as $cs )
                <tr class="body-table">
                    <td class="body-row">{{ $no++ }}</td>
                    <td class="body-row">{{ $cs->nama_customer }}</td>
                    <td class="body-row">{{ $cs->alamat }}</td>
                    <td class="body-row">{{ $cs->no_hp }}</td>
                    <td class="body-row">
                        <div class="action-btn">
                            <a href="{{ route('edit-customer', encrypt($cs->id) ) }}">
                                <div class="btn-edit">
                                    <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="">
                                </div>
                            </a>

                            <form action="{{route('delete-customer', ($cs->id))}}" method="POST">
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
              Detail Contact Costomer
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
                        <th class="header-row" style="width:200px">Customer</th>
                        <th class="header-row" style="width: 411px;">Nama Lengkap</th>
                        <th class="header-row" style="width:177px">Jabatan</th>
                        <th class="header-row" style="width: 130px;">Email</th>
                        <th class="header-row" style="width: 130px;">No Telpon</th>
                        <th class="header-row" style="width: 130px;">Detail</th>
                        <th class="header-row" >Action</th>
                </tr>
                @foreach ($detailContact as $detail )
                <tr class="body-table">
                    <td class="body-row">{{ $no++ }}</td>
                    <td class="body-row">{{ $detail->customers->nama_customer}}</td>
                    <td class="body-row">{{ $detail->nama_lengkap }}</td>
                    <td class="body-row">{{ $detail->jabatan }}</td>
                    <td class="body-row">{{ $detail->email }}</td>
                    <td class="body-row">{{ $detail->no_hp }}</td>
                    <td class="body-row">
                        <div class="btn-detail customer" data-id="{{ $detail->id }}">
                            Detail
                        </div>
                    </td>
                    <td class="body-row">
                        <div class="action-btn">
                            <div class="btn-edit customer" data-id="{{ $detail->id }}">
                                <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="">
                            </div>
                            <div class="btn-delete">
                                <img src="{{ asset('Assets/icon/icon _trash_.png') }}" alt="">
                            </div>
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
            $('.card-create-customer.cp-customer').removeClass('close-hide').addClass('show');
            e.stopPropagation();
            e.preventDefault();
        })

        $('.btn-detail.customer').on('click', function(e){

            e.stopPropagation();
            e.preventDefault();
            var id = $(this).attr('data-id');
            setDetail(id)
        })

        $('.btn-edit.customer').on('click', function(e){
            e.stopPropagation();
            e.preventDefault();
            var id = $(this).attr('data-id');
            setform(id);

        })

        $('.btn-save-form').on('click', function(){

            postData()
        });
        
        $('.close').on('click', function(){
            $('.container-popup-card-create').removeClass('show').addClass('close-hide');
            $('.card-create-customer.cp-customer').removeClass('show').addClass('close-hide');
        }).on('click', function(){
            $('.container-popup-card-create').removeClass('show').addClass('close-hide');
            $('.card-create-customer.detail-data').removeClass('show').addClass('close-hide');
        })



        function setform(id){
            var obj ={};

            obj["_token"] = "{{ csrf_token() }}";
            obj['id'] = id;
            $.ajax({
                 url: "{{route('edit-customer-contact')}}",
                 data: obj,
                 method : 'GET',
                 success : function(result){
                     form(result.data, result.customer);
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
                 url: "{{route('edit-customer-contact')}}",
                 data: obj,
                 method : 'GET',
                 success : function(result){
                    detail(result.data, result.customer);
                     console.log(result.data, result.customer);
                 }
             }).fail(function(data){
             console.log(data);
             });
         }

         function form(data, customer){
             var $formSet = $('.form-card');
             $formSet.data('id', data.id);
             $formSet.find('.col-form-p-input #customer option:selected.old-customer').val(data.fid_customer).text(customer.nama_customer);
             $formSet.find('.col-form-p-input.namaLengkap input').val(data.nama_lengkap);
             $formSet.find('.col-form-p-input.jabatan input').val(data.jabatan);
             $formSet.find('.col-form-p-input.departemen input').val(data.departemen);
             $formSet.find('.col-form-p-input.email input').val(data.email);
             $formSet.find('.col-form-p-input.noHp input').val(data.no_hp);

             $('.container-popup-card-create').removeClass('close-hide').addClass('show');
             $('.card-create-customer.cp-customer')
                .removeClass('close-hide')
                .addClass('show')
                .find('.text-tittle').text('Edit Contact');
         }

         function detail(data, customer){
            var $cardDetail = $('.card-create-customer.detail-data');
            $cardDetail.find('.v-data.name-Customer').text(customer.nama_customer);
            $cardDetail.find('.v-data.nama-lengkap').text(data.nama_lengkap);
            $cardDetail.find('.v-data.jabatan').text(data.jabatan);
            $cardDetail.find('.v-data.departemen').text(data.departemen);
            $cardDetail.find('.v-data.email').text(data.email);
            $cardDetail.find('.v-data.nohp').text(data.no_hp);

            $('.container-popup-card-create').removeClass('close-hide').addClass('show');
            $('.card-create-customer.detail-data').removeClass('close-hide').addClass('show');
         }

         function clearForm(){
             var $formSet = $('.form-card');
             $formSet.removeData('id');
             $formSet.find('.col-form-p-input #customer').removeData('fid_customer');
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
             var masterCustomer = $formSet.find('.col-form-p-input #customer option:selected').attr('value');
             var namaLengkap =  $formSet.find('.col-form-p-input.namaLengkap input').val();
             var jabatan = $formSet.find('.col-form-p-input.jabatan input').val();
             var departement =   $formSet.find('.col-form-p-input.departemen input').val();
             var email =  $formSet.find('.col-form-p-input.email input').val();
             var noHp = $formSet.find('.col-form-p-input.noHp input').val();

             obj['fid_customer'] = masterCustomer;
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
                 url: "{{route('upload-customer-contact')}}",
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
