@extends('layoute.latoute')
@section('content')

@include('dashboard.part-lain.popUp_edit_form_user')
<div class="content-dashboard">
    {{--  <div class="navigation-tab">
        <div class="nav-tab active" target-panel="panel1" order="1">Customer</div>
        <div class="nav-tab" target-panel="panel2" order="2">Detail Contact</div>
    </div>  --}}

    <div class="header-content">
            <p class="text-tittle">
                Data Acount Admin
            </p>
            <a href="{{ route('registrasi') }}">
                <div class="button-create">
                        <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                        <p>New Admin</p>
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
                        <th class="header-row" style="width:200px">Username</th>
                        <th class="header-row" style="width: 411px;">Nama Admin</th>
                        <th class="header-row" style="width:177px">Email</th>
                        <th class="header-row" style="width:177px">No Handphone</th>
                        <th class="header-row" style="width: 130px;">Role</th>
                        <th class="header-row" style="width: 130px;">Action</th>
                </tr>
                @foreach ($user as $admin )
                <tr class="body-table">
                    <td class="body-row">{{ $no++ }}</td>
                    <td class="body-row"><a href="#">{{ $admin->username }}</a></td>
                    <td class="body-row">{{ $admin->nama }}</td>
                    <td class="body-row">{{ $admin->email }}</td>
                    <td class="body-row">{{ $admin->no_hp }}</td>
                    <td class="body-row">{{ $admin->role_admin->nama_role }}</td>
                    <td class="body-row">
                        <div class="action-btn">
                            <div class="btn-edit" data-id="{{ $admin->id }}">
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
@stop

@section('script')
<script>
    $(()=>{
        $('.btn-edit').on('click', function(e){
            e.stopPropagation();
            e.preventDefault();
            var id = $(this).attr('data-id');
            setForm(id);
        })

        $('.close').on('click', function(){
            $('.container-popup-card-create').removeClass('show').addClass('close-hide');
            $('.card-create-customer.user').removeClass('show').addClass('close-hide');
        });
        $('.btn-save-form.user').on('click', function(){
            postData();
        });


        function setForm(id){
            var obj ={};
            obj["_token"] = "{{ csrf_token() }}";
            obj['id'] = id;
            $.ajax({
                url: "{{route('admin-edit')}}",
                data: obj,
                method : 'GET',
                success : function(result){
                    form(result.data, result.role);
                    //console.log(data);
                }
            }).fail(function(data){
            console.log(data);
            });
        }

        function form(data, role){
            var $formSet = $('.form-card');
            $formSet.data('id', data.id);
            $formSet.find('.col-form-p-input#role option:selected.old-role').val(data.role).text(role.nama_role);
            $formSet.find('.col-form-p-input.u-name input').val(data.username);
            $formSet.find('.col-form-p-input.name input').val(data.nama);
            $formSet.find('.col-form-p-input.email input').val(data.email);
            $formSet.find('.col-form-p-input.noHp input').val(data.no_hp);

            $('.container-popup-card-create').removeClass('close-hide').addClass('show');
            $('.card-create-customer.user').removeClass('close-hide').addClass('show');

        }



           function postData(){
            var obj = {};
            var $formSet = $('.form-card');
            var id = $formSet.data('id');
            var role = $formSet.find('.col-form-p-input#role option:selected').attr('value');
            var username = $formSet.find('.col-form-p-input.u-name input').val();
            var name =$formSet.find('.col-form-p-input.name input').val();
            var email = $formSet.find('.col-form-p-input.email input').val();
            var no_hp =  $formSet.find('.col-form-p-input.noHp input').val();


            obj['role'] = role;
            obj['username'] = username;
            obj['nama'] = name;
            obj['email'] = email;
            obj['no_hp'] = no_hp;

            //console.log(obj['fid_group']);

            obj["_token"] = "{{ csrf_token() }}";
            if(id){
                obj['id'] = id;
            }
            $.ajax({
                url: "{{route('update-edit')}}",
                data: obj,
                method : 'POST',
                success : function(result){
                    console.log('success', result);
                    //clearForm();
                    $('.container-popup-card-create').removeClass('show').addClass('close-hide');
                    $('.card-create-customer.user').removeClass('show').addClass('close-hide');
                    window.location.reload();
                }
            }).fail(function(data){
               console.log(data);
            });
           }
    })
</script>
@stop
