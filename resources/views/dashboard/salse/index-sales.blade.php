@extends('layoute.latoute')
@section('content')


<div class="content-dashboard">
    <div class="header-content">
        <p class="text-tittle">
            Sales
        </p>
        <a href="{{ route('create-sales') }}">
            <div class="button-create">
                    <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                    <p>New Sales</p>
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
                    <th class="header-row" style="width:200px">No Fakture/Invoice</th>
                    <th class="header-row" style="width:116px">Tanggal</th>
                    <th class="header-row" style="width:177px">Customer</th>
                    <th class="header-row" style="width:202px">Total</th>
                    <th class="header-row">Status</th>
                    <th class="header-row" style="width: 139px;">Action</th>
               </tr>
               @foreach ($sales as $penjualan )
               <tr class="body-table">
                <td class="body-row">{{ $no++ }}</td>
                <td class="body-row">{{ $penjualan->no_faktur }}</td>
                <td class="body-row">{{ $penjualan->tanggal }}</td>
                <td class="body-row">{{ $penjualan->customer->nama_customer }}</td>
                <td class="body-row">Rp. {{number_format( $penjualan->grand_total, 2, ',','.')}} </td>
                <td class="body-row"></td>
                <td class="body-row">
                    <div class="action-btn">
                        <div class="btn-print">
                            <img src="{{ asset('Assets/icon/icon_print_.png') }}" alt="" class="print">
                            <img src="{{ asset('Assets/icon/icon _chevron down.png') }}" alt="" class="dropdown">
                            <div class="dropdown-print-action off">
                                <ul class="action-list">
                                    <li class="action-btn"> <a href="{{ route('invoice', encrypt($penjualan->id)) }}"> Invoice</a></li>
                                    <li class="action-btn"> <a href="{{ route('sj', encrypt($penjualan->id)) }}">Surat Jalan</a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="btn-edit pembayaran" data-id="{{ $penjualan->id }}">
                            <img src="{{ asset('Assets/icon/icon _money_.png') }}" alt="" srcset="">
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

<div class="container-popup-cd-pembayaran close-hide">
    <div class="card-position">
        <div class="card-create-customer " style="width: 832px;">
            <div class="header-card-create">
                <p class="text-tittle">
                   Pembayaran
                </p>
                <p class="close"> X </p>
            </div>
            <div class="form-card payment-sales">

                <form action="{{ route('postPembayaran') }}" method="post">
                    @csrf
                    <div class="row-form">
                        {{--  <form action="">  --}}
                            <div class="Purchase-date">
                                <label for="date-purchase">Tanggal</label>
                                <input type="date" name="tanggal" id="date_pembayaran">
                                {{--  <input id="txtId" type="hidden" class="form-control txt">  --}}
                            </div>
                        {{--  </form>  --}}
                        <div class="i-form-sales">
                            <label for="nofaktur">RP</label>
                            <input type="text" name="total" class="i-form jumlah" placeholder="0">
                        </div>
                        <div class="i-form-sales ppn">
                            <label for="nofaktur">PPN</label>
                            <input type="checkbox" name="ppn" id="" value="0.11" class="ppn">
                            <input type="text" name="total_ppn" class="i-form jumlah_ppn" placeholder="0">
                        </div>
                        <div class="vendor-selection">
                            <label for="vendor">Pembayaran</label>
                            <select name="pembayaran" id="" placeholder="Select pembayaran" class="pembayaran-methode">
                                <option class="metode_pb" value="">--Metode Pembayaran--</option>
                                <option class="metode_pb" value="Trasfer">Tarnsfer</option>
                                <option class="metode_pb" value="Cash">Cash</option>
                                <option class="metode_pb" value="Debit">Debit</option>
                            </select>
                        </div>
                    </div>
                    <div class="row-form">
                        <div class="description">
                            <label for="dsc">Description</label>
                            <textarea name="keterangan" id="" cols="40" rows="6" class="dsc"></textarea>
                        </div>
                        <div class="btn-tambah-pyment" data-id="">
                            <div class="btn-pyment" >
                                <input type="hidden" name="fid_penjualan">
                                Tambah Pembayaran
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            <div class="tbl-pembayaran">
                @php $no=1; @endphp
                <table class="tbl">
                    <thead class="tbl-head">
                        <tr class="tr-tbl-payment">
                            <th class="th-tbl-payment">No</th>
                            <th class="th-tbl-payment">Tanggal</th>
                            <th class="th-tbl-payment">Pembayaran</th>
                            <th class="th-tbl-payment">Total</th>
                            <th class="th-tbl-payment">PPN</th>
                            <th class="th-tbl-payment" style="width: 157px;">Keterangan</th>
                            <th class="th-tbl-payment">Diperiksa</th>
                            <th class="th-tbl-payment">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbl-body-payment">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')
<script>
   $(()=>{
        $('.btn-print').on('click', function(){
            $(this).find('.dropdown-print-action').slideToggle("fast");

        });


    $('.pembayaran').on('click', function(e){
        e.stopPropagation();
        e.preventDefault();
        var $elm = $(this);
        var idx = $elm.attr('data-id');
        getPembayaran(idx);
        $('.container-popup-cd-pembayaran').removeClass('close-hide').addClass('show');
        $('.container-popup-cd-pembayaran .btn-tambah-pyment').attr('data-id',idx);

    });

    $('.i-form-sales input.ppn').on('click', function(){
        var $elm = $(this);
        if($elm.prop('checked', true)){
            const ppn = $elm.val();
            const Bayar = $('input[name="total"]').val();
            const hasil = parseInt(Bayar) * parseFloat(ppn);
            $('input[name="total_ppn"]').val(hasil).text(hasil);
             console.log(Bayar, ppn, hasil);
        }
    })

    $('.btn-tambah-pyment').on('click', function(){
        var idx = $(this).attr('data-id');
        console.log(idx);
        $('.btn-pyment input[name="fid_penjualan"]').val(idx);
        $('.form-card.payment-sales form').submit();

    });

    $('.close').on('click', function(){
        $('.container-popup-cd-pembayaran').removeClass('show').addClass('close-hide');
    })

    function getPembayaran(idx){
        console.log(idx);
        $.ajax({
            url: '{{ route('pembayaran') }}',
            data: {sales: idx},
            method: 'GET',
            type: 'json',
            success: function(result){
                var $elm = $('.tbl-body-payment');
                $elm.html('');
                var no = 1;

                $.each(result.data, function(index , item){
                    $elm.append("<tr class='tbl-tr-body'>"+
                        "<td class='tbl-td-body-payment'>"+ no +"</td>"+
                        "<td class='tbl-td-body-payment'>"+item.tanggal+"</td>"+
                        "<td class='tbl-td-body-payment'>"+item.pembayaran+"</td>"+
                        "<td class='tbl-td-body-payment'>"+item.total+"</td>"+
                        "<td class='tbl-td-body-payment'>"+item.total_ppn+"</td>"+
                        "<td class='tbl-td-body-payment'>"+item.keterangan+"</td>"+
                        "<td class='tbl-td-body-payment'>"+"<p>{{ Auth()->user()->nama }}</p>"+"</td>"+
                        `<td class="tbl-td-body-payment"><div class="p-kw-form"><a href="{{route('kwitansi', '')}}/${item.id}">Kwitansi</a></div></td>`
                        +"</tr>"
                    );
                    no++;
                 });
            }
        }).fail(function(data){
            console.log(data);
        });
    }

     function kwitansi(id){

     }


   });
</script>
@stop
