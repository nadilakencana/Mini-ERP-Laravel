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
                <div class="filter-date">
                    <p>Filter Date</p>
                    <img src="{{ asset('Assets/icon/🦆 icon _calendar_.png') }}" alt="" class="icon_calender" id="calender_id">

                </div>
                <div class="calender off">
                   <div id="dycalendar"></div>

                </div>
            </div>
        </div>
        <div class="table-data">
            @php $no=1; @endphp
            <table>
               <tr class="header-table">
                    <th class="header-row" >No</th>
                    <th class="header-row" style="width:200px">No Fakture/Invoice</th>
                    <th class="header-row" style="width:116px">Tanggal</th>
                    <th class="header-row" style="width:177px">Customer</th>
                    <th class="header-row" style="width:202px">Total</th>
                    <th class="header-row">Status</th>
                    <th class="header-row" style="width: 100px;">Action</th>
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
        <div class="card-create-customer " style="width: 653px;">
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
                            <th class="th-tbl-payment" style="width: 157px;">Keterangan</th>
                            <th class="th-tbl-payment">Diperiksa</th>
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


    $('.pembayaran').on('click', function(e){
        e.stopPropagation();
        e.preventDefault();
        var $elm = $(this);
        var idx = $elm.attr('data-id');
        getPembayaran(idx);
        $('.container-popup-cd-pembayaran').removeClass('close-hide').addClass('show');
        $('.container-popup-cd-pembayaran .btn-tambah-pyment').attr('data-id',idx);

    });

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
                        "<td class='tbl-td-body-payment'>"+item.keterangan+"</td>"+
                        "<td class='tbl-td-body-payment'>"+"</td>"+
                    "</tr>"
                    );
                    no++;
                 });
            }
        }).fail(function(data){
            console.log(data);
        });
    }

    function postData(idx){
        var obj = {};
        var $formSet = $('.form-card.payment-sales');
        var id = $formSet.data('id');
        var tanggal = $formSet.find('input[name="tanggal"]').val();
        var jumlah =  $formSet.find('input[name="total"]').val();
        var metodeBayar = $formSet.find('vendor-selection .pembayaran-methode option:selected').val();
        var deskripsi = $formSet.find('textarea[name="deskripPembayaran"]').val();
        var idx = $formSet.find('input[name="id"]').val(idx);

        console.log(idx);
        obj["_token"] = "{{ csrf_token() }}";
        obj['fid_penjualan'] = idx;
        obj['tanggal'] = tanggal;
        obj['pembayaran'] = metodeBayar;
        obj['total'] = jumlah;
        obj['keterangan'] = deskripsi;
        if(id){
            obj['id'] = id;
        }
        $.ajax({
            url: "{{route('postPembayaran')}}",
            data: obj,
            method : 'POST',
            success : function(result){
                console.log('success', result);

                window.location.reload();
            }
        }).fail(function(data){
           console.log(data);
        });
    }


   });
</script>
@stop
