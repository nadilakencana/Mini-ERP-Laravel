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
                            <div class="btn-edit">
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
            $('.container-popup-card-create').removeClass('close-hide').addClass('show');
            $('.card-create-customer.user').removeClass('close-hide').addClass('show');
            e.stopPropagation();
            e.preventDefault();
        })

        $('.close').on('click', function(){
            $('.container-popup-card-create').removeClass('show').addClass('close-hide');
            $('.card-create-customer.user').removeClass('show').addClass('close-hide');
        });
    })
</script>
@stop
