@foreach ( $Pembelian as $purchase)
<tr class="body-table">

    <td class="body-row">{{ $purchase->no_faktur }}</td>
    <td class="body-row">{{ $purchase->tanggal }}</td>
    <td class="body-row">{{ $purchase->suplier->nama_supplier }}</td>
    <td class="body-row">Rp. {{number_format( $purchase->grand_total, 2, ',','.')}}</td>
    <td class="body-row">
        @if ($purchase ->status == 'Lunas')
        <div class="status-Lunas">{{ $purchase->status }}</div>
        @else
        <div class="status-proses">{{ $purchase->status }}</div>
        @endif
    </td>
    <td class="body-row">
        <div class="action-btn">
            <a href="{{ route('EditPO', encrypt($purchase->id) ) }}">
                <div class="btn-edit">
                    <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="">
                </div>
            </a>
            <div class="btn-print">
                <img src="{{ asset('Assets/icon/icon_print_.png') }}" alt="" class="print">
                <img src="{{ asset('Assets/icon/icon _chevron down.png') }}" alt="" class="dropdown">
                <div class="dropdown-print-action off" style="margin-top: 81px;">
                    <ul class="action-list">
                        <li class="action-btn"><a href="{{ route('suratpo',  encrypt($purchase->id)) }}">Surat PO</a></li>
                        <li class="action-btn"><a href="{{ route('suratpo-PT',  encrypt($purchase->id)) }}">Surat PO PT</a></li>
                    </ul>
                </div>
            </div>
            <div class="btn-edit pembayaran" data-id="{{ $purchase->id }}">
                <img src="{{ asset('Assets/icon/icon _money_.png') }}" alt="" srcset="">
            </div>
            <div class="btn-delete">
                <img src="{{ asset('Assets/icon/icon _trash_.png') }}" alt="">
            </div>

        </div>

    </td>
</tr>
@endforeach
