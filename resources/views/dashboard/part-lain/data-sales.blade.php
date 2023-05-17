@php $no=1; @endphp

@foreach ($sales as $penjualan )
<tr class="body-table">
     
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
