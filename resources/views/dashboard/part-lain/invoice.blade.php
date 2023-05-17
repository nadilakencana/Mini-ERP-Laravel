<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

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

            margin-right: 25px;
            margin-top: 30px;

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
            font-weight: 900;
            margin-top: 29px;
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
            width: 143px;
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
            align-items: flex-end;
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
            margin: 10px 55px;
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
        .setting-print-inv {
            {{--  display: flex;  --}}
            align-items: center;
        }
        .setting-print-inv .setting-box {
            display: flex;
            flex-wrap: wrap;
            padding: 20px;
            gap: 20px;
            width: 833px;
        }
        .setting-print-inv .setting-box .item-set-print {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .item-set-print .name-set {
            display: flex;
            gap: 10px;
        }
        .name-set input.input-name-set {
            border: 1px solid grey;
            border-radius: 10px;
            width: 85px;
            padding: 10px;
        }
        .name-set input.persen {
            border: 1px solid grey;
            border-radius: 10px;
            width: 54px;
        }
        .item-set-print input.nominal {
            border: 1px solid grey;
            border-radius: 10px;
            width: 113px;
            padding: 10px;
        }
        .action-set {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .save-set {
            padding: 13px;
            background: #8fc38f;
            border-radius: 14px;
            color: white;
            cursor: pointer;
        }
        .hapus-set {
            padding: 13px;
            background: #e95c5c;
            border-radius: 14px;
            color: white;
            cursor: pointer;
        }
    </style>


</head>

<body>
    <div class="setting-print-inv">
        <div class="name-head">Setting Print Invoice</div>
        <div class="setting-box">
            <div class="item-set-print">
                <div class="name-set">
                    <label for="">Name</label>
                    <input type="text" class="input-name-set" placeholder="nama pembayaran">
                    <input type="text" class="persen" placeholder="persent%"> %
                </div> =
                <input type="text" class="nominal">
            </div>
            <div class="item-set-print">
               <label for="">PPN</label>
               <input type="checkbox" name="" id="" class="ppn" data-idx="{{ $sales->fid_group }}">
            </div>
            <div class="action-set">
                <div class="save-set">Add+</div>
                <div class="hapus-set">Delete</div>
                <div class="button-save-pdf">Save PDF</div>
            </div>
            <div class="item-set-print">
                <label for="">Rekening Mandiri PT</label>
                <input type="checkbox" name="" id="" class="Rek-mandiri">
             </div>
        </div>
    </div>

   <div class="invoice">
        <div class="header-invoice">
            <div class="left-header-kode">-{{ $kodeGroup }}-</div>
            <p class="titel">FAKTUR</p>
            <div class="right-detail-pengiriman">
                <div class="tanggal">
                    <p>Tanggal Faktur :</p>
                    <p class="tgl">{{Carbon\Carbon::parse($sales->tanggal)->format('d M Y')}}</p>
                </div>
                <div class="no-faktur">
                    <p>Nomer Faktur :</p>
                    <p class="faktur">{{ $sales->no_faktur }}</p>
                </div>

                <div class="alamat">
                    <p class="yth">Kepada Yth:</p>
                    <p class="detail-alamat">
                       {{ $detail->alamat }}
                    </p>
                    <div class="penerima">
                        <p class="name">Penerima  </p>
                        <p class="penerima-nama">: {{ $sales->customer->nama_customer }}</p>
                    </div>
                    <div class="hp">
                        <p class="nohp">HP </p>
                        <p class="telphon">: {{ $sales->customer->no_hp }}</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="isi-invoice">
            <table>
                <thead>
                    <th>No</th>
                    <th style="width: 100px" >Tipe</th>
                    <th style="width: 290px;">Kode Barang</th>
                    <th style="width: 150px;">Warna</th>
                    <th>Qty</th>
                    <th style="width: 150px;">Harga</th>
                    <th style="width: 150px;">Total</th>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach ($barang as $product )
                    <tr>
                        <td style="text-align: center;">{{ $no++ }}</td>
                        <td>{{ $product->jenis->nama_jenis }}</td>
                        <td>
                            <div class="detail-barang">
                                <p class="kode"> {{ $product->alias->nama_alias }}</p>
                                <p class="desc">Ket: {{ $product->keterangan }}
                                </p>
                            </div>
                        </td>
                        <td>{{ $product->variasi->nama_varian }}</td>
                        <td>{{ $product->jumlah }}</td>
                        <td>Rp.<span style="float: right;">{{ number_format($product->harga_satuan, 0,',','.') }}</span> </td>
                        <td>Rp.<span style="float: right;">{{ number_format($product->total, 0,',','.') }}</span></td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
            <div class="footer-table">
                @php
                    $grand_total = 0;

                    if(isset($pembayaran->fid_penjualan)){
                        $PembayaranDp = $pembayaran->total;
                        $ppn = 11 / 100 ;
                        $ppnDp = $PembayaranDp * $ppn;

                        $total = $PembayaranDp + $ppnDp;

                    }else{
                        $subtotal = $sales->sub_total;

                        $total = $subtotal;
                    }
                @endphp
                <div class="sub-total">
                    <p>Nilai Penjualan</p>
                    <p>Rp. <span class="subtot" style="float: right;">{{ number_format($sales->sub_total, 0,',','.') }}</span> </p>
                </div>
                {{--  @if(!! $sales->diskon_nominal)
                <div class="sub-total">
                    <p>Discount</p>
                    <p>Rp. <span style="float: right;">{{ number_format($sales->diskon_nominal, 0,',','.') }}</span> </p>
                </div>
                @else
                <div class="sub-total">
                    <p>Discount</p>
                    <p>Rp. <span style="float: right;">0</span> </p>
                </div>
                @endif  --}}

                @if(isset($pembayaran->fid_penjualan))
                <div class="sub-total">
                    <p class="name-pembayaran">Uang Muka <p class="persent-pembayaran"></p></p>
                    <p>Rp.<span class="pembayaran" style="float: right;">{{ number_format($pembayaran->total, 0,',','.') }}</span></p>
                </div>
                <div class="sub-total">
                    <p>PPN</p>
                    <p>Rp.<span class="ppn-pembayaran" style="float: right;">{{ number_format($ppnDp, 0,',','.') }}</span> </p>
                </div>
                <div class="line"></div>
                <div class="sub-total" style="margin-top: 10px;">
                    <p> TOTAL</p>
                    <p>Rp. <span class="total" style="float: right;">{{ number_format($total , 0,',','.') }}</span> </p>
                </div>
               <div class="duobel-line"></div>
                @else
                <div class="sub-total">
                    <p class="name-pembayaran">Uang Muka <span class="persent-pembayaran"></span></p>
                    <p>Rp.<span class="pembayaran" style="float: right;">0</span></p>
                </div>
                <div class="sub-total">
                    <p>PPN</p>
                    <p>Rp.<span class="ppn-pembayaran" style="float: right;">0</span> </p>
                </div>
                <div class="line"></div>
                <div class="sub-total" style="margin-top: 10px;">
                    <p > TOTAL</p>
                    <p>Rp. <span class="total-bayar" style="float: right;">{{ number_format($total , 0,',','.') }}</span> </p>
                </div>
               <div class="duobel-line"></div>
                @endif

            </div>
        </div>
        <div class="footer-invoice">
            <div class="tanda-tangan">
                <div class="tanda-terima">
                    <p>TANDA TERIMA,</p>
                    <span>(..................)</span>
                </div>
                <div class="hormat-kami">
                    <p>HORMAT KAMI,</p>
                    <img src="{{ asset('Assets/image/gfi.png') }}" alt="" srcset="" style="width: 145px;">
                    <span style="margin-top: 16px;">(PT.Griya Fortuna Internasional)</span>
                </div>
            </div>
            <div class="footer-note">
                <p>Catatan :</p>
                <div class="rekening">{{ $sales->groupToko->rekening_no_ppn }}</div>
                <ul>
                    <li>- Sisa uang dilunasi dengan uang tunai.</li>
                    <li>- Barang-barang yang sudah dipesan tidak dapat ditukar.</li>
                    <li>- Pembatalan pemesanan uang muka hilang.</li>
                    <li>- Faktur ini hanya berlaku selama 30 hari, lewat batas waktu dianggap batal.</li>
                </ul>
            </div>
        </div>
   </div>



   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script>


       document.querySelector('.button-save-pdf').addEventListener('click', function() {
           var element = document.querySelector('.invoice');
           var opt = {
           filename:     'Invoice.pdf',
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

       $(()=>{
            $('.setting-print-inv .item-set-print .persen').on('input', function(){
                var subtot = $('.sub-total span.subtot').text();

                var subFormatNum = parseInt(subtot.replace(/\./g,''));
                console.log(subFormatNum);
                var target = $(this).val();
                var presentens = parseFloat(target / 100);
                var jumlah = subFormatNum * presentens;
                $('.item-set-print input.nominal').val(jumlah);
            });

            $('.action-set .save-set').on('click', function(){
                var namaPayment = $('input.input-name-set').val();
                var persent = $('input.persen').val();
                var nominalPembayaran = $('input.nominal').val();
                var convert = parseInt(nominalPembayaran).toLocaleString('id-ID',{
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                })
                console.log(namaPayment, persent, convert);

                $('.sub-total p.name-pembayaran').text(namaPayment);
                $('.sub-total p.name-pembayaran .persent-pembayaran').text(persent);
                $('.sub-total .pembayaran').text(convert);
                $('.sub-total .total-bayar').text(convert);
            })

            $('.item-set-print .ppn').on('change', function(){
                var idx = $(this).attr('data-idx');
                var nominalPembayaran = $('input.nominal').val();
                var ppn = parseInt(nominalPembayaran) * (parseFloat(11 / 100));
                console.log(ppn, idx);
                var convertPPN = parseInt(ppn).toLocaleString('id-ID',{
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                });
                var total = parseInt(nominalPembayaran) + ppn;
                var convertTotal = parseInt(total).toLocaleString('id-ID',{
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                });
                $('.sub-total .ppn-pembayaran').text(convertPPN);
                $('.sub-total .total-bayar').text(convertTotal);

                getDataToko(idx);

            })

            $('.item-set-print .Rek-mandiri').on('change', function(){
                addRekeningMandiri();
            })

            function getDataToko(id){
                var obj ={};
                obj["_token"] = "{{ csrf_token() }}";
                obj['id'] = id;

                $.ajax({
                    url : "{{ route('getDataToko') }}",
                    data: obj,
                    method : 'GET',
                    success : function(result){
                        dataToko(result.data);
                    }
                }).fail(function(data){
                    console.log(data);
                });
            }

            function dataToko(data){
                var $target = $('.footer-note');
                $target.find('.rekening').text(data.rekening_ppn);
                console.log(data.rekening_ppn);
            }

            function addRekeningMandiri(){
                var $target = $('.footer-note');
                $target.find('.rekening').append('</br>'+
                ' Bank Mandiri 1550010546979 A/N PT. Griya Fortuna Internasional, Cabang Mutiara Kosambi'
                );

            }
       })

   </script>
</body>
</html>

