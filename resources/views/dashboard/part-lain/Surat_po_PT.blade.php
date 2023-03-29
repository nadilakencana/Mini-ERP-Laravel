<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Purchase Order</title>

    <style>
        .purchase-layoute {
            display: block;
            border: 1px solid;
            margin: 50px;
            font-size: 10px;
            width: 666px;
        }
        .header-surat-po {
            display: flex;
            flex-direction: row;
            border-bottom: 1px solid;
        }

        .image {
            margin: 5px 0px;
        }
        .image img {
            width: 214px;
        }

        p.txt-header {
            font-size: 23px;
            margin-left: 49px;
            font-weight: bold;
            margin-bottom: 0px;
            margin-top: 31px;
        }
        .header-isi{
            display:flex;
            gap: 26px;
        }
        .detail-vendor {
            width: 50%;
            border-right: 1px solid;
        }
        .row {
            display: flex;
            border-bottom: 1px solid;
        }
        .label {
            width: 101px;
            border-right: 1px solid;
            padding: 2px;
            /* padding-left: 2px; */
        }
        .text-name {
            padding: 2px;
        }
        .detail-po {
            border-left: 1px solid;
            height: fit-content;
        }
        .product {
            margin: 20px 0px;
        }
        table {
            border-collapse: collapse;
            border-top: 1px solid;
            width: 100%;
            border-bottom: 1px solid;
        }
        .product thead tr {
            border-bottom: 1px solid;
            background: #b4c6e7;
        }
        tbody tr {
            border-bottom: 1px solid;
        }
        .product  tbody tr td {
            text-align: center;
            padding-right: 10px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .subtotal {
            display: flex;
            justify-content: flex-end;
            border-bottom: 1px solid;
        }
        .subtotal .label-foot {
            background: yellow;
            padding: 4px;
            border-left: 1px solid;
            border-right: 1px solid;
            font-weight: bold;
            font-size: 13px;
            width: 235px;
        }
        .subtotal p {
            margin: 0px;
            background: yellow;
            padding: 4px;
            font-size: 12px;
            font-weight: bold;
            width: 111px;
            text-align: end;
        }
        .grandtotal {
            display: flex;
            border-bottom: 1px solid;
        }
        .grandtotal .label-foot {
            width: 88%;
            background: red;
            border-right: 1px solid;
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            padding: 4px;
        }
        .grandtotal p {
            text-align: end;
            width: 121px;
            background: red;
            margin: 0px;
            font-weight: bold;
            padding: 4px;
            font-size: 13px;
        }
        .note-desc {
            padding: 8px 35px;
        }
        .note-desc p {
            margin: 0px;
            font-weight: bold;
        }
        .tanda-tangan-surat {
            display: flex;
            margin-top: 20px;
            justify-content: space-between;
        }
        .pre-by {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .img {
            padding: 10px;
        }
        .img img {
            width: 183px;
        }
        .button-save-pdf {
            cursor: pointer;
            background: #b32424;
            padding: 10px;
            width: 112px;
            margin: 20px;
            text-align: center;
            color: white;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="button-save-pdf">Save PDF</div>
    <div class="purchase-layoute">
        <div class="header-surat-po">
            <div class="image">
                <img src="{{ asset('Assets/image/logo GFI.png') }}" alt="" srcset="">
            </div>
            <p class="txt-header">PURCHASE ORDER</p>
        </div>
        <div class="body-isi">
            <div class="header-isi">
                <div class="detail-vendor">
                    <div class="row">
                        <div class="label">Vendor</div>
                        <div class="text-name">{{ $purchase->suplier->nama_supplier }}</div>
                    </div>
                    <div class="row">
                        <div class="label">PIC</div>
                        <div class="text-name">{{ $detail_sup->nama_lengkap }}</div>
                    </div>
                    <div class="row">
                        <div class="label">Phone</div>
                        <div class="text-name">{{ $detail_sup->no_hp }}</div>
                    </div>
                    <div class="row">
                        <div class="label">Fax</div>
                        <div class="text-name">-</div>
                    </div>
                    <div class="row">
                        <div class="label">Addres</div>
                        <div class="text-name">PT. Griya Fortuna Internasional</div>
                    </div>
                    <div class="row">
                        <div class="label">From</div>
                        <div class="text-name" style="width: 222px;">{{ $alamat_admin->group->alamat }}</div>
                    </div>
                    <div class="row">
                        <div class="label">NPWP </div>
                        <div class="text-name">95.681.967.6-453.000</div>
                    </div>

                </div>
                <div class="detail-po">
                    <div class="row">
                        <div class="label">Ref. No</div>
                        <div class="text-name">{{ $purchase->no_faktur }}</div>
                    </div>
                    <div class="row">
                        <div class="label">Date</div>
                        <div class="text-name">{{Carbon\Carbon::parse($purchase->tanggal)->format('d M Y')}}</div>
                    </div>
                    <div class="row">
                        <div class="label">Delivery Date </div>
                        <div class="text-name">{{Carbon\Carbon::parse($purchase->tanggal_kirim)->format('d M Y')}}</div>
                    </div>
                    <div class="row">
                        <div class="label">Delivery Address</div>
                        <div class="text-name" style="width: 63%;">Komplek Interkota Blok 5F-G, Jl. Lingkar Luar
                            Barat , Duri Kosambi, Cengkareng, Jakarta Barat
                            (UP : Bpk. Prabowo / 0817-0820-477)</div>
                    </div>
                    <div class="row">
                        <div class="label">Term Of Payment</div>
                        <div class="text-name">Transfer </div>
                    </div>
                </div>
            </div>

            <div class="product">
                <table>
                    <thead>
                        <th>No</th>
                        <th>Product</th>
                        <th>Varian</th>
                        <th>QTY</th>
                        <th>Unit Price</th>
                        <th>Total Amount</th>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($barang as $br)
                        <tr>
                            <td>{{$no++ }}</td>
                            <td>{{ $br->alias->alias }}</td>
                            <td>{{ $br->variasi->nama_varian }}</td>
                            <td>{{ $br->jumlah }}</td>
                            <td style="text-align: end;">{{ number_format($br->harga_satuan , 0,',','.') }}</td>
                            <td style="text-align: end;">{{ number_format($br->pembelian->sub_total, 0,',','.') }} </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="footer-total-table">
                    <div class="subtotal">
                        <div class="label-foot">Subtotal</div>
                        <p>{{ number_format($purchase->sub_total , 0,',','.') }}</p>
                    </div>
                    <div class="grandtotal">
                        <div class="label-foot">Garnd Total</div>
                        <p>{{ number_format($purchase->sub_total, 0,',','.') }}</p>
                    </div>
                </div>
                <div class="note-desc">
                    <p>* Harga sudah termasuk PPN 11%</p>
                    <p>* Mohon lampirkan PO saat kirim invoice</p>
                </div>
                <div class="tanda-tangan-surat">
                    <div class="pre-by">
                        <div class="label-ttd">
                            Prepared By
                        </div>
                        <div class="img">
                            <img src="{{ asset('Assets/image/logo GFI.png') }}" alt="" srcset="">
                        </div>
                        <div class="name">({{ Auth()->user()->nama }})</div>
                    </div>
                    <div class="pre-by">
                        <div class="label-ttd">
                            Approved By
                        </div>

                        <div class="name" style="margin-top: 86px;">(Minto Raharjo)</div>
                    </div>
                    <div class="pre-by">
                        <div class="label-ttd">
                            Received By
                        </div>

                        <div class="name" style="margin-top: 86px;margin-right: 10px;">({{ $purchase->suplier->nama_supplier }})</div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>


        document.querySelector('.button-save-pdf').addEventListener('click', function() {
            var element = document.querySelector('.purchase-layoute');
            var opt = {
            filename:     'Surat PO.pdf',
            html2canvas:  { scale: 2 },
            jsPDF: {
                format: 'A4',
                orientation: 'portrait' ,
                width: 794,
            }

            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();
        });

    </script>
</body>
</html>
