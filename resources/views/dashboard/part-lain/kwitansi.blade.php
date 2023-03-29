<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kwitansi Pembayaran</title>


    <style>
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
        .kwitansi-layoute {
            display: flex;
            flex-direction: column;
            border: 1px solid;
            margin-right: 20px;
        }
        .header-kwitansi {
            display: flex;
            flex-direction: column;
        }
        .head {
            display: flex;
            gap: 20px;
            height: 50px;
            align-items: center;
            border-bottom: 1px solid;
        }
        .prusahaan-name {
            font-weight: 900;
            border-right: 1px solid;
            height: 50px;
            width: 50%;
            align-self: center;
            padding-left: 10px;
        }
        .sub-head {
            display: flex;
            justify-content: center;
            border-bottom: 1px solid;
            padding: 10px 0px;
        }
        .title-kwitansi {
            text-align: center;
        }
        .taxt-title {
            border-bottom: 1px solid;
        }
        .detail-kwitansi {
            display: flex;
            flex-direction: column;
            padding: 4px 8px 13px 11px;
            height: 161px;
            border-bottom: 1px solid;
        }
        .row {
            display: flex;
            gap: 48px;
        }
        .label {
            width: 134px;
        }
        .label p.text-name {
            margin: 0px;
            border-bottom: 1px solid;
        }
        .footer-kwitansi {
            display: flex;
            flex-direction: row;
        }
        .Keterangan {
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-left: 5px;
        }
        .nominal {
            border-bottom: 1px solid;
            border-top: 1px solid;
            width: 132px;
            padding: 3px;
        }
        .note {
            font-size: 12px;
            width: 264px;
        }
        .tanda-tangan {
            position: relative;
            text-align: center;
            width: 50%;
        }
        .tanda-tangan .name {
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="button-save-pdf">Save PDF</div>
    <div class="kwitansi-layoute">
        <div class="header-kwitansi">
            <div class="head">
                <div class="prusahaan-name">
                   <p>PT. GRIYA FORTUNA INTERNASIONAL</p>
                </div>
                <div class="no-faktur">
                    {{ $penjualan->no_faktur }}
                </div>
            </div>
            <div class="sub-head">
                <div class="title-kwitansi">
                    <div class="taxt-title">
                        KWITANSI
                    </div>
                    <span class="text-ing">Receipt</span>
                </div>
            </div>

        </div>
        <div class="detail-kwitansi">
            <div class="row">
                <div class="label">
                    <p class="text-name">Sudah Terima Dari</p>
                    <span class="text-ing">Received From</span>
                </div>
                <div class="name">: {{ $customer->nama_customer }} </div>
            </div>
            <div class="row">
                <div class="label">
                    <p class="text-name">Banyaknya Uang</p>
                    <span class="text-ing">Amount Received</span>
                </div>
                @php
                    $kalimat =  Riskihajar\Terbilang\Facades\Terbilang::make($pembayaran->total);
                @endphp
                <div class="name">: &#35; {{ ucwords( $kalimat ) }} Rupiah &#35; </div>
            </div>
            <div class="row">
                <div class="label">
                    <p class="text-name">Untuk Pembayaran</p>
                    <span class="text-ing">In Payment Of</span>
                </div>
                <div class="name">: {{ $pembayaran->keterangan }} </div>
            </div>
        </div>
        <div class="footer-kwitansi">
            <div class="Keterangan">
                <div class="nominal">
                    Rp. &#35; {{ number_format($pembayaran->total , 0,',','.') }} &#35;
                </div>
                <div class="note">
                    Kwitansi ini baru dianggap sah, setelah pembayaran dengan Giro/Cek/Transfer dapat
                    diuangkan/masuk ke rekening PT. GRIYA FORTUNA INTERNASIONAL
                    A/C. 08 296 78910
                </div>
            </div>
            <div class="tanda-tangan">
                <div class="tanggal-kwitansi">
                    Tangerang Selatan, 12 Desember 2022
                </div>
                <div class="name">
                    (Kusuma Wijaya)
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script>
       document.querySelector('.button-save-pdf').addEventListener('click', function() {
           var element = document.querySelector('.kwitansi-layoute');
           var opt = {
           filename:     'Kwitansi Pembayaran.pdf',
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
