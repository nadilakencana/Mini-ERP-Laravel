@extends('layoute.latoute')
@section('content')

@include('dashboard.part-lain.popUp-SJ')
<div class="content-dashboard">
    <div class="header-content">
        <p class="text-tittle">
            Surat Jalan
        </p>
        <a href="{{ route('create-sales') }}">
            <div class="button-create" idx="{{ $idx->id }}">
                    <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                    <p>Dropshiper</p>
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

                    <th class="header-row" style="width:200px">No Surat jalan</th>
                    <th class="header-row" style="width:200px">No Faktur</th>
                    <th class="header-row" style="width:116px">Tanggal</th>
                    <th class="header-row" style="width:116px">Tanggal Kirim</th>
                    <th class="header-row" style="width:177px">Customer</th>
                    <th class="header-row">Status</th>
                    <th class="header-row" style="width: 111px;">Action</th>
               </tr>
               @foreach ($sj as $Delivery )
               <tr class="body-table">
                    <td class="body-row">{{ $Delivery->no_surat_jalan }}</td>
                    <td class="body-row">{{ $Delivery->SO->no_faktur }}</td>
                    <td class="body-row">{{ $Delivery->tanggal_sj}}</td>
                    <td class="body-row">{{ $Delivery->tanggal_kirim}}</td>
                    <td class="body-row">{{ $Delivery->SO->customer->nama_customer}}</td>
                    <td class="body-row">{{ $Delivery->status}} </td>

                    <td class="body-row">
                        <div class="action-btn">
                            <div class="btn-detail">
                                Detail
                            </div>
                            <div class="btn-print">
                                <img src="{{ asset('Assets/icon/icon_print_.png') }}" alt="" class="print">
                            </div>
                        </div>

                    </td>
                </tr>
               @endforeach

            </table>
        </div>
    </div>
</div>
@stop

@section('script')
<script>
    $(()=>{
        $('.btn-detail').on('click', function(){
            $('.container-popup.detai-sj').removeClass('close-hide').addClass('show');
        });
        $('.close-doc').on('click', function(){
            $('.container-popup.detai-sj').removeClass('show').addClass('close-hide');
        })
        $('.btn-close-pop').on('click', function(){
            $('.container-popup.detai-sj').removeClass('show').addClass('close-hide');
        })
    })
</script>

@stop
