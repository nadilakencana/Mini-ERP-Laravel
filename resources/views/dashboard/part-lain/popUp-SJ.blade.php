<div class="container-popup detai-sj close-hide">
    <div class="sj-doc-detail">
        <div class="header-doc">
            <div class="tittle">Travel Document Detail</div>
            <div class="close-doc">X</div>
        </div>
        <div class="detail-barang">
            <div class="l-detail-barang">
                <div class="table-detail-barang">
                    <p>Detail Barang</p>
                    <table class="tbl-sj">
                        <tr class="header-tbl">
                            <th class="header-table-detail">No:</th>
                            <th class="header-table-detail">Nama Barang</th>
                            <th class="header-table-detail">Tipe</th>
                            <th class="header-table-detail">Warna</th>
                            <th class="header-table-detail">Qty</th>
                        </tr>
                        @php $no=1; @endphp
                        @foreach ($detailBarang as $item )

                                <tr class="body-tbl">
                                    <td class="data-detail-delivery">{{ $no++ }}</td>
                                    <td class="data-detail-delivery">{{ $item->AliasBarang->alias}}</td>
                                    <td class="data-detail-delivery">{{ $item->jenisBarang->nama_jenis }}</td>
                                    <td class="data-detail-delivery">{{ $item->Varian->nama_varian }}</td>
                                    <td class="data-detail-delivery">{{ $item->jumlah }}</td>
                                </tr>

                        @endforeach

                    </table>
                </div>
                <div class="d-tujuan-delivery">
                    <p>Detail Tujuan</p>
                    <div class="t-delivery">
                        <div class="data">
                            <label for="name">Nama</label>
                            <p class="tx-data" style="margin-left: 10px;">{{ $detailSj->customer }}</p>
                        </div>
                        <div class="data">
                            <label for="alamat">Alamat</label>
                            <p class="tx-data">{{ $detailSj->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="r-detail-sj">
                <p class="t-sj">Detail Sj</p>
                <p class="tgl-sj">{{ \Carbon\Carbon::parse($detailSj->tanggal_sj)->format( 'd-M-Y') }}</p>
                <div class="detail-isi">
                    <div class="d-detail-sj">
                        <p class="txt-d-sj">Kode Toko</p>
                        <p class="txt-data-d-sj">{{ $kode }}</p>
                    </div>
                    <div class="d-detail-sj">
                        <p class="txt-d-sj">Nomer SJ</p>
                        <p class="txt-data-d-sj" style="margin-left: 5px;">{{ $detailSj->no_surat_jalan  }}</p>
                    </div>
                    <div class="d-detail-sj">
                        <p class="txt-d-sj">Nomer Faktur</p>
                        <p class="txt-data-d-sj"  style="margin-left: 42px;">{{ $detailSj->SO->no_faktur  }}</p>
                    </div>
                    <div class="d-detail-sj">
                        <p class="txt-d-sj">Tanggal Kirim</p>
                        <p class="txt-data-d-sj" style="margin-left: -33px;">{{\Carbon\Carbon::parse($detailSj->tanggal_kirim)->format( 'd-M-Y') }}</p>
                    </div>
                    <div class="d-detail-sj">
                        <p class="txt-d-sj">Type Surat</p>
                        <p class="txt-data-d-sj" style="margin-left: -33px;">{{ $detailSj->jenis_surat_jalan  }}</p>
                    </div>
                    <div class="d-detail-sj">
                        <p class="txt-d-sj">Type Pengiriman</p>
                        <p class="txt-data-d-sj" style="margin-left: -33px;">{{ $detailSj->pengiriman  }}</p>
                    </div>
                    <div class="admin">
                        <p>{{ $detailSj->Admin->username  }}</p>
                    </div>
                </div>
            </div>
        </div>
        {{--  <div class="btn-action">
            <div class="btn-close-pop">Close</div>
            <div class="btn-print-pop">Print</div>
        </div>  --}}
    </div>
</div>
