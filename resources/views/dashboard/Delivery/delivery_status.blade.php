@extends('layoute.latoute')
@section('content')
@include('dashboard.part-lain.popUp-SJ')
<div class="content-dashboard">
    <div class="header-content">
        <p class="text-tittle">
            Delivery Status
        </p>
        {{--  <a href="{{ route('create-product') }}">
            <div class="button-create">
                    <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                    <p>New Product</p>
            </div>
        </a>  --}}
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
                <div class="vendor-selection">
                    <div class="select-c">
                        <select name="" id="" placeholder="Select Vendor">
                            <option value="">In Production</option>
                            <option value="">UnProduction</option>
                        </select>
                    </div>
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
                    <th class="header-row" style="width:124px">Kode Toko</th>
                    <th class="header-row" style="width:173px">Nama Admin</th>
                    <th class="header-row" style="width:237px">Alamat</th>
                    <th class="header-row" style="width:159px">Nomer SJ</th>
                    <th class="header-row" style="width:145px">Tanggal SJ</th>
                    <th class="header-row" style="width: 100px">Status</th>
                    <th class="header-row" style="width: 100px">Action</th>
               </tr>
               <tr class="body-table">
                    <td class="body-row">1</td>
                    <td class="body-row"><a href="{{ route('edit-product') }}">data</a></td>
                    <td class="body-row">data</td>
                    <td class="body-row">data</td>
                    <td class="body-row">data</td>
                    <td class="body-row">data</td>
                    <td class="body-row">
                        <div class="status-production">
                            In Production
                        </div>
                    </td>
                    <td class="body-row">
                        <div class="btn-detail">
                            Detail
                        </div>
                    </td>
               </tr>
               <tr class="body-table">
                    <td class="body-row">2</td>
                    <td class="body-row"><a href="{{ route('edit-product') }}">data</a></td>
                    <td class="body-row">data</td>
                    <td class="body-row">data</td>
                    <td class="body-row">data</td>
                    <td class="body-row">data</td>
                    <td class="body-row">
                        <div class="status-Unproduction">
                            UnProduction
                        </div>
                    </td>
                    <td class="body-row">
                        <div class="btn-detail">
                            Detail
                        </div>
                    </td>
               </tr>
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
    $('.btn-detail').on('click', function(){
        $('.container-popup').addClass('show').removeClass('close-hide');
        e.stopPropagation();
        e.preventDefault();

    });
    $('.close-doc').on('click', function(){
        $('.container-popup').removeClass('show').addClass('close-hide');
    });
</script>
@stop
