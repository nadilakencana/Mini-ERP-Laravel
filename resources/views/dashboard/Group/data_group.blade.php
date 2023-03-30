@extends('layoute.latoute')
@section('content')

{{--  @include('dashboard.Group.popup_Edit_data')  --}}
<div class="content-dashboard">
    {{--  <div class="navigation-tab">
        <div class="nav-tab active" target-panel="panel1" order="1">Customer</div>
        <div class="nav-tab" target-panel="panel2" order="2">Detail Contact</div>
    </div>  --}}

    <div class="header-content">
            <p class="text-tittle">
                Data Group/Toko
            </p>
            <a href="{{ route('createGroup') }}">
                <div class="button-create">
                        <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                        <p>New Group</p>
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
                        <th class="header-row" style="width:200px">Group/Toko</th>
                        <th class="header-row" style="width: 411px;">Kode Invoice</th>
                        <th class="header-row" style="width:177px">Alamat</th>
                        <th class="header-row" style="width:177px">No Telphon</th>
                        <th class="header-row" style="width: 130px;">Logo</th>
                        {{--  <th class="header-row" style="width: 130px;">Shoppe</th>
                        <th class="header-row" style="width: 130px;">Tokopedia</th>  --}}
                        <th class="header-row" style="width: 130px;">Action</th>
                </tr>
                @foreach ($group as $gp )
                <tr class="body-table">
                    <td class="body-row">{{ $no++ }}</td>
                    <td class="body-row"><a href="#">{{ $gp->nama_toko }}</a></td>
                    <td class="body-row">{{ $gp->kode_invoice}}</td>
                    <td class="body-row">{{ $gp->alamat }}</td>
                    <td class="body-row">{{ $gp->no_telpon }}</td>
                    <td class="body-row" ><img src="{{$gp->logo_toko  }}" alt="" srcset="" style="width: 100px;" class="logo_toko"></td>
                    {{--  <td class="body-row" style="width: 130px;">{{ $gp->tokopedia_hook }}</td>
                    <td class="body-row" style="width: 130px;">{{ $gp->shoppee_hook }}</td>  --}}
                    <td class="body-row">
                        <div class="action-btn">
                            <a href="{{ route('EditGroup', encrypt($gp->id)) }}">
                                <div class="btn-edit">
                                    <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="">
                                </div>
                            </a>
                            <form action="{{route('DeleteGroup', ($gp->id))}}" method="POST">
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
            </div>
            <div class="footer-table">
                <div class="data-total">Showing 1-10 entries</div>
                <div class="pagination"></div>
            </div>
    </div>


</div>
@stop

@section('script')
<script>
    /*$('.btn-edit').on('click', function(){

        $('.container-popup-card-variasi').addClass('show').removeClass('close-hide');
        $('.card-create-product').addClass('variasi-in');
        e.stopPropagation();
        e.preventDefault();
    })*/
    /*$('.close-create').on('click', function(){
        $('.container-popup-card-variasi').removeClass('show').addClass('close-hide');
        $('.card-create-product').removeClass('variasi-in');
    });*/
</script>
@stop
