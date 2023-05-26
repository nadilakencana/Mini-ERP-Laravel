<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Jalan</title>
    {{--  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>  --}}

    <style>


        body{
            font-family: 'Bahnschrift' !important;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background-color: white;
            min-width: 824px;

        }

        *{
            box-sizing:border-box;
        }
        p {
            margin-top: 4px;
            margin-bottom: 4px;
        }
        .invoice {
            margin: 30px 20px;
        }
        .header-invoice {
            display: flex;
            justify-content: space-between;
        }
        .right-detail-pengiriman {
            width: 304px;
            line-height: 16px;
            font-size: 14px;
        }
        .alamat {
            width: 300px;
        }
        .left-header-kode {
            margin-top: 29px;
            width: 200px;
            height: 200px;
        }
        .left-header-kode img {
           width: 100%;
        }
        p.titel {
            font-weight: bold;
            align-self: center;
            border-bottom: 2px solid black;
            line-height: 11px;
        }
        .tanggal {
            display: flex;
        }
        .tanggal p {
            margin: 0;
            width: 125px;
        }
        .no-faktur {
            display: flex;
        }
        .no-faktur p {
            margin: 5px 0px;
            width: 143px;
        }
        .penerima {
            display: flex;
            gap: 10px;
        }
        .penerima p{
           margin: 0px;
        }
        .hp {
            display: flex;
            gap: 10px;
        }
        .hp p{
            margin: 3px 0px;
        }
        .isi-invoice {
            margin-top: 33px;
        }
        .isi-invoice table {
            border-collapse: collapse;
            border-bottom: 2px solid;
            width: 100%;
        }
        .isi-invoice table thead {
            border-top: 1px solid;
            border-bottom: 1px solid;
        }
        .isi-invoice table thead tr th {
            padding-bottom: 5px;
            padding-top: 10px;
            padding-left: 10px;
            text-align: start;
        }
        .isi-invoice table tbody tr td {
            padding: 0px 10px;
            font-size: 12px;
        }
        .isi-invoice table tbody tr td .detail-barang {
            width: 219px;
        }
        .footer-table {
            display: flex;
            flex-direction: column;
            margin-top: 10px;
            padding: 2px 0px 4px 0px;
            font-size: 14px;
        }
        .sub-total {
            display: flex;
            gap: 20px;
        }
        .sub-total p {
            width: 120px;
            margin: 1px;
        }
        .line {
            width: 135px;
            border-bottom: 2px solid;
        }
        .duobel-line {
            border-bottom: 1px solid;
            border-style: double;
            width: 135px;
            margin-top: 10px;
        }
        .tanda-tangan {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            margin: 10px 6px;
        }
        .tanda-tangan .tanda-terima {
            width: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .tanda-tangan .hormat-kami {
            width: 263px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .tanda-tangan span {
            margin-top: 55px;
        }
        .footer-note {
            margin: 20px 0px 19px 2px;
            font-size: 13px;
        }
        li {
            list-style: none;
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
   <div class="invoice">
        <div class="header-invoice">
            <div class="left-header-kode">
                <img src="{{ $kodeGroup }}" alt="">
            </div>
            <p class="titel">SURAT JALAN</p>
            <div class="right-detail-pengiriman">
                <div class="tanggal">
                    <p>Tanggal Faktur</p>
                    <p class="tgl">:{{Carbon\Carbon::parse($sj->tanggal_sj)->format('d M Y')}}</p>
                </div>
                <div class="no-faktur">
                    <p>Nomer Surat Jalan </p>
                    <p class="faktur" style="width: 200px;">:  {{  $sj->no_surat_jalan	 }}</p>
                </div>
                <div class="no-faktur">
                    <p>Nomer Faktur </p>
                    <p class="faktur" style="width: 200px;">:  {{  $sj->SO->no_faktur	 }}</p>
                </div>

                <div class="alamat">
                    <p class="yth">Kepada Yth:</p>
                    <p class="detail-alamat">
                        {{  $sj->alamat	 }}
                    </p>
                    <div class="penerima">
                        <p class="name">Penerima  </p>
                        <p class="penerima-nama">: {{  $sj->customer	 }}</p>
                    </div>
                    <div class="hp">
                        <p class="nohp">HP </p>
                        <p class="telphon">:{{  $sj->SO->customer->no_hp	 }} </p>
                    </div>

                </div>
            </div>
        </div>
        <div class="isi-invoice">
            <table>
                <thead>
                    <th>No</th>
                    <th style="width: 100px" >Tipe</th>
                    <th style="width: 290px;">Nama Barang</th>
                    <th style="width: 150px;">Warna</th>
                    <th>Qty</th>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach ($detail as $product )
                    <tr>
                        <td style="text-align: center;">{{ $no }}</td>
                        <td>{{ $product->jenisBarang->nama_jenis }}</td>
                        <td>
                            <div class="detail-barang">
                                <p class="kode"> {{ $product->AliasBarang->alias }}</p>
                                <p class="desc">Ket: {{ $product->keterangan }}
                                </p>
                            </div>
                        </td>
                        <td>{{ $product->Varian->nama_varian }}</td>
                        <td>{{ $product->jumlah }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="footer-table">
                <div class="tanggal-kirim">
                    <span>Tanggal Kirim</span>
                    <span>:{{Carbon\Carbon::parse($sj->tanggal_kirim)->format('d M Y')}}</span>
                </div>
            </div>
        </div>
        <div class="footer-invoice">
            <div class="tanda-tangan">
                <div class="tanda-terima">
                    <p>TANDA TERIMA,</p>
                    <span>(..................)</span>
                </div>
                <span style="margin-top: 92px;" >Supir :  ....................</span>
                <div class="hormat-kami">
                    <p>HORMAT KAMI,</p>
                    <span>(..................)</span>
                </div>
            </div>
            <div class="footer-note">
                <p>Catatan :</p>
                <ul>
                    <li>
                        - Barang-barang telah diterima dalam jumlah yang benar dan dalam keadaan baik.
                    </li>
                    <li>- Barang yang telah dibeli tidak dapat ditukar atau dikembalikan.</li>
                </ul>
            </div>
        </div>
   </div>



   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script>
       document.querySelector('.button-save-pdf').addEventListener('click', function() {
           var element = document.querySelector('.invoice');
           var opt = {
           filename:     'Surat Jalan.pdf',
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
