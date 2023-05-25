@extends('layoute.latoute')
@section('content')


<div class="content-dashboard">
    <div class="navigation-tab">
        <div class="nav-tab active" target-panel="panel1" order="1">Sales Order</div>
        <div class="nav-tab" target-panel="panel2" order="2">Approved SO</div>
    </div>
    <div class="panel active" data-panel="panel1" panel-order="1">
        <div class="header-content">
            <p class="text-tittle">
                Sales Order
            </p>
            <a href="{{ route('create-sales') }}">
                <div class="button-create">
                        <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                        <p>New Sales</p>
                </div>
            </a>
        </div>

        {{--  card-content  --}}
        <div class="card-content-display" style="height: 500px">
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
                <div class="button-section-display">
                    <div class="date_search">
                        <label for="">Bulan</label>
                        <div class="tanggal month">
                            <input  name="tanggal" class="datepicker" id="date">
                        </div>
                        <button type="submit" class="filter">Cari</button>
                    </div>

                </div>
            </div>
            <div class="table-data">
                @php $no=1; @endphp
                <table id="data-table" class="data">
                   <tr class="header-table">

                        <th class="header-row" style="width:200px">No Faktur/Invoice</th>
                        <th class="header-row" style="width:116px">Tanggal</th>
                        <th class="header-row" style="width:177px">Customer</th>
                        <th class="header-row" style="width:202px">Total</th>
                        <th class="header-row">Status</th>
                        <th class="header-row" style="width: 111px;">Action</th>
                   </tr>
                   @foreach ($sales as $penjualan )
                   <tr class="body-table">
                        <td class="body-row">{{ $penjualan->no_faktur }}</td>
                        <td class="body-row">{{ $penjualan->tanggal }}</td>
                        <td class="body-row">{{ $penjualan->customer->nama_customer }}</td>
                        <td class="body-row">Rp. {{number_format( $penjualan->grand_total, 2, ',','.')}} </td>
                        <td class="body-row">
                            @if ($penjualan ->status == 'Lunas')
                            <div class="status-Lunas">{{ $penjualan->status }}</div>
                            @else
                            <div class="status-proses">{{ $penjualan->status }}</div>
                            @endif
                        </td>
                        <td class="body-row">
                            <div class="action-btn">
                                <a href="{{ route('EditSo', encrypt($penjualan->id) ) }}">
                                    <div class="btn-edit">
                                        <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="">
                                    </div>
                                </a>

                                <div class="btn-print">
                                    <img src="{{ asset('Assets/icon/icon_print_.png') }}" alt="" class="print">
                                    <img src="{{ asset('Assets/icon/icon _chevron down.png') }}" alt="" class="dropdown">
                                    <div class="dropdown-print-action off">
                                        <ul class="action-list">
                                            <li class="action-btn"> <a href="{{ route('invoice', encrypt($penjualan->id)) }}"> Invoice</a></li>
                                            <li class="action-btn"> <a href="{{ route('ListSuratJalan', encrypt($penjualan->id)) }}">Surat Jalan</a></li>

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
            </div>
        </div>
    </div>
    <div class="panel" data-panel="panel2" panel-order="2">
        <div class="header-content">
            <p class="text-tittle">
                Approved Sales Order
            </p>
            {{--  <a href="{{ route('create-sales') }}">
                <div class="button-create">
                        <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                        <p>New Sales</p>
                </div>
            </a>  --}}
        </div>
        @auth

        @endauth
        {{--  card-content  --}}
        <div class="card-content-display" style="height: 500px">
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
                <div class="button-section-display">
                    <div class="date_search">
                        <label for="">Bulan</label>
                        <div class="tanggal month">
                            <input  name="tanggal" class="datepicker" id="date">
                        </div>
                        <button type="submit" class="filter">Cari</button>
                    </div>

                </div>
            </div>
            <div class="table-data">
                @php $no=1; @endphp
                <table id="data-table" class="data">
                   <tr class="header-table">

                        <th class="header-row" style="width:200px">No Faktur/Invoice</th>
                        <th class="header-row" style="width:116px">Tanggal</th>
                        <th class="header-row" style="width:177px">Customer</th>
                        <th class="header-row" style="width:202px">Total</th>
                        <th class="header-row">Status</th>
                        <th class="header-row" style="width: 111px;">Action</th>
                   </tr>
                   @foreach ($aprovSO as $penjualan )
                   <tr class="body-table">
                        <td class="body-row">{{ $penjualan->no_faktur }}</td>
                        <td class="body-row">{{ $penjualan->tanggal }}</td>
                        <td class="body-row">{{ $penjualan->customer->nama_customer }}</td>
                        <td class="body-row">Rp. {{number_format( $penjualan->grand_total, 2, ',','.')}} </td>
                        <td class="body-row">
                            @if ($penjualan ->status == 'Lunas')
                            <div class="status-Lunas">{{ $penjualan->status }}</div>
                            @else
                            <div class="status-proses">{{ $penjualan->status }}</div>
                            @endif
                        </td>
                        <td class="body-row">
                            <div class="action-btn">
                                {{--  <a href="{{ route('EditSo', encrypt($penjualan->id) ) }}">
                                    <div class="btn-edit">
                                        <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="">
                                    </div>
                                </a>

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
                                </div>  --}}
                                @if (Auth()->user()->role_admin->nama_role == 'Marketing')
                                <div class="btn-delete">
                                    <img src="{{ asset('Assets/icon/icon _trash_.png') }}" alt="">
                                </div>
                                @else
                                <div class="btn-approved" idx="{{ $penjualan->id }}">
                                    Approved
                                </div>
                                <div class="btn-delete">
                                    <img src="{{ asset('Assets/icon/icon _trash_.png') }}" alt="">
                                </div>
                                @endif
                            </div>

                        </td>
                    </tr>
                   @endforeach

                </table>
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
                        <div class="Purchase-date">
                            <label for="date-purchase">Tanggal</label>
                            <input type="date" name="tanggal" id="date_pembayaran">
                        </div>
                        <div class="vendor-selection">
                            <label for="vendor">Pembayaran</label>
                            <select name="type_pembayaran" id="" placeholder="Select pembayaran" class="pembayaran-methode">
                                <option class="metode_pb" value="">--Metode Pembayaran--</option>
                                <option class="metode_pb" value="Trasfer">Tarnsfer</option>
                                <option class="metode_pb" value="Cash">Cash</option>
                                <option class="metode_pb" value="Debit">Debit</option>
                            </select>
                        </div>
                        <div class="i-form-sales">
                            <label for="nofaktur">RP</label>
                            <input type="text" name="total" class="i-form jumlah" placeholder="0" style="width:86px;">
                        </div>
                        <div class="i-form-sales ppn" >
                            <div class="i-form-sales row-ppn" style="flex-direction: row;">
                                <label for="nofaktur">PPN</label>
                                <input type="text" name="ppn" id="" class=" i-form ppn" style="width: 10px; height: 20px;">
                            </div>
                            <input type="text" name="total_ppn" class="i-form jumlah_ppn" placeholder="0" style="width: 105px; height: 65px;" >
                        </div>
                        <div class="i-form-sales">
                            <label for="nofaktur">Total Bayar</label>
                            <input type="text" name="total_bayar" class="i-form totalBayar" placeholder="0" style="width:86px;">
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
                            <th class="th-tbl-payment">Total Bayar</th>
                            {{--  <th class="th-tbl-payment">PPN</th>  --}}
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


        $('.nav-tab').on('click', function(e) {
            var target = $(this).attr('target-panel');
            $('.nav-tab').removeClass('active');
            $(this).addClass('active');

            $('.panel').hide();
            console.log();
            $(`.panel[data-panel="${target}"]`).show();
        })

        $('.btn-print').on('click', function(){
            $(this).find('.dropdown-print-action').slideToggle("fast");
        });

        $(".datepicker").datepicker({
            dateFormat: 'yy-mm',
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            onClose: function(dateText, inst) {
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).val($.datepicker.formatDate('yy-mm', new Date(year, month, 1)));
            }
        });

        $(".datepicker").focus(function () {
            $(".ui-datepicker-calendar").hide();
            $("#ui-datepicker-div").position({
                my: "center top",
                at: "center bottom",
                of: $(this)
            });
        });

        $('.date_search button.filter').on('click', function(){
            filtermonth();
        });

        function filtermonth(){
            var month = $('.date_search .month input').val();
            console.log(month);
            var $tableRows = $('table tr.body-table');
            $tableRows.each(function(){
                // Ambil nilai pada kolom tanggal (misalnya, kolom ketiga)
              const rowDate = $(this).find("td:nth-child(2)").text();
              console.log(rowDate);
              const monthNum = new Date(`${month}`).getMonth() + 1;
                // Jika nilai tanggal pada baris sama dengan tanggal yang dicari, tampilkan baris
                if (Number(rowDate.split('-')[1]) === Number(monthNum)) {
                    $(this).show();
                  } else {
                    // Jika tidak, sembunyikan baris
                    $(this).hide();
                  }
            })
        }

    $('.pembayaran').on('click', function(e){
        e.stopPropagation();
        e.preventDefault();
        var $elm = $(this);
        var idx = $elm.attr('data-id');
        getPembayaran(idx);
        $('.container-popup-cd-pembayaran').removeClass('close-hide').addClass('show');
        $('.container-popup-cd-pembayaran .btn-tambah-pyment').attr('data-id',idx);

    });

    $('.i-form-sales input.ppn').on('input', function(){
        var $elm = $(this);

            const ppn = parseFloat($elm.val() / 100);
            const Bayar = $('input[name="total"]').val();
            const hasil = parseInt(Bayar) * parseFloat(ppn);
            var total_ppn = $('.i-form-sales.ppn input.jumlah_ppn').val(hasil).text(hasil);
            var total_bayar = parseInt(Bayar) + parseFloat(hasil);

            $('.i-form-sales input.totalBayar').val(total_bayar).text(total_bayar);

             console.log(total_ppn);

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
                        "<td class='tbl-td-body-payment'>"+item.type_pembayaran+"</td>"+
                        "<td class='tbl-td-body-payment'>"+parseInt(item.total_bayar).toLocaleString("id-ID", { style: "currency", currency: "IDR" })+"</td>"+
                        //"<td class='tbl-td-body-payment'>"+item.total_ppn+"</td>"+
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


    let part = 1;

    $(window).scroll(function() {
        if($(window).scrollTop() == $(document).height() - $(window).height()) {
            part++
            getData(part);
        }
    });

    function getData(part){

        let URL = "{{ route('dataGetSales') }}"+ '?page=' + part;
        console.log(URL);
        $.get(URL, function(result){
            if(result.length > 0){
                $(result).appendTo('.table-data .data');

                part++;
            }


        }).fail(function(result){
            console.log(result);

        });

     }

     $('.btn-approved').on('click', function(){
        var idx = $(this).attr('idx');
        approved(idx)
    });

    function approved(id){

        var url ="{{ route('approvalEdit','') }}";
        baseURL = url + '/' + id;
        $.ajax({
            url:baseURL,
            method: 'POST',
            type: 'json',
            //_token : "{{ csrf_token() }}",
            data:{
            //    data:data,
              _token : "{{ csrf_token() }}"
            },
            success: function(data){
                console.log(data);
                window.location.reload();
            },

        }).fail(function(data){

        console.log(data);

    });
    }

   });
</script>
@stop
