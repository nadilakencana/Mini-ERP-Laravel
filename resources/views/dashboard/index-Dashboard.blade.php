@extends('layoute.latoute')
@section('content')

<div class="content-dashboard">
    <div class="header-content">
        <p class="text-tittle">
            Hai,{{ Auth()->user()->nama }}
        </p>
    </div>
    <div class="card-content">
        <div class="card color-1">
            <div class="isi">
                <div class="isi-head">
                    <span class="titel-card">
                        Invoice Jatuh Tempo
                    </span>
                </div>
                <div class="main-isi">
                    <img src="{{ asset('Assets/image/Document.png') }}" alt="">
                    <p class="text">30</p>
                </div>
            </div>

        </div>
        <div class="card color-2">
            <div class="isi">
                <div class="isi-head">
                    <span class="titel-card">
                        Pembelian
                    </span>
                </div>
                <div class="main-isi">
                    <img src="{{ asset('Assets/image/trolli.png') }}" alt="">
                    <p class="text">30</p>
                </div>
            </div>

        </div>
        <div class="card color-3">
            <div class="isi">
                <div class="isi-head">
                    <span class="titel-card">
                        Penjualan
                    </span>
                </div>
                <div class="main-isi">
                    <img src="{{ asset('Assets/image/Tag.png') }}" alt="">
                    <p class="text">30</p>
                </div>
            </div>

        </div>
        <div class="card color-4">
            <div class="isi">
                <div class="isi-head">
                    <span class="titel-card">
                       Kas/Bank
                    </span>
                </div>
                <div class="main-isi">
                    <img src="{{ asset('Assets/image/Bank.png') }}" alt="">
                    <p class="text">30</p>
                </div>
            </div>

        </div>

    </div>
    <div class="section-content">
        <div class="grafik-content">
            <div class="header-grafik">
                <div class="tittel-grafik">Pendapatan</div>
                <div class="rate">
                   <p>Rate: 7 Hari Terakhir</p>
                   <div class="btn-rate" id="btnRate">
                    <img src="{{ asset('Assets/icon/icon _chevron down.png') }}" alt="">
                   </div>

                </div>
                <div class="dropdown-list hide ">
                    <ul class="list-rate">
                        <li class="rate-list"> 7 Hari Terakhir</li>
                        <li class="rate-list"> 20 Hari Terakhir</li>
                        <li class="rate-list"> 30 Hari Terakhir</li>
                        <li class="rate-list"> 60 Hari Terakhir</li>
                        <li class="rate-list"> 1 Tahun Terakhir</li>
                    </ul>
               </div>
            </div>
            <div class="grafik">
                <canvas id="myChart" width="580" height="290"></canvas>
                {{--  <img src="{{ asset('Assets/image/Chart.png') }}" alt="">  --}}
            </div>
        </div>
        <div class="card-section">
            <div class="card-data">
                <div class="header-card">
                    <p>Data Invoice Jatuh Tempo</p>
                </div>
                <div class="isi-card-data">
                    <div class="list-data">
                        <div class="code-data">inv07deka22</div>
                        <div class="name-customer">RSCM</div>
                        <div class="date-data">21-jan-2023</div>
                    </div>
                    <div class="list-data">
                        <div class="code-data">inv07deka22</div>
                        <div class="name-customer">RSCM</div>
                        <div class="date-data">21-jan-2023</div>
                    </div>
                    <div class="list-data">
                        <div class="code-data">inv07deka22</div>
                        <div class="name-customer">RSCM</div>
                        <div class="date-data">21-jan-2023</div>
                    </div>
                    <div class="list-data">
                        <div class="code-data">inv07deka22</div>
                        <div class="name-customer">RSCM</div>
                        <div class="date-data">21-jan-2023</div>
                    </div>
                    <div class="list-data">
                        <div class="code-data">inv07deka22</div>
                        <div class="name-customer">RSCM</div>
                        <div class="date-data">21-jan-2023</div>
                    </div>
                    <div class="list-data">
                        <div class="code-data">inv07deka22</div>
                        <div class="name-customer">RSCM</div>
                        <div class="date-data">21-jan-2023</div>
                    </div>
                    <div class="list-data">
                        <div class="code-data">inv07deka22</div>
                        <div class="name-customer">RSCM</div>
                        <div class="date-data">21-jan-2023</div>
                    </div>
                    <div class="list-data">
                        <div class="code-data">inv07deka22</div>
                        <div class="name-customer">RSCM</div>
                        <div class="date-data">21-jan-2023</div>
                    </div>
                    <div class="list-data">
                        <div class="code-data">inv07deka22</div>
                        <div class="name-customer">RSCM</div>
                        <div class="date-data">21-jan-2023</div>
                    </div>
                    <div class="list-data">
                        <div class="code-data">inv07deka22</div>
                        <div class="name-customer">RSCM</div>
                        <div class="date-data">21-jan-2023</div>
                    </div>
                    <div class="list-data">
                        <div class="code-data">inv07deka22</div>
                        <div class="name-customer">RSCM</div>
                        <div class="date-data">21-jan-2023</div>
                    </div>
                    <div class="list-data">
                        <div class="code-data">inv07deka22</div>
                        <div class="name-customer">RSCM</div>
                        <div class="date-data">21-jan-2023</div>
                    </div>
                    <div class="list-data">
                        <div class="code-data">inv07deka22</div>
                        <div class="name-customer">RSCM</div>
                        <div class="date-data">21-jan-2023</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')
<script>
    const ctx = document.getElementById('myChart');
    const axt = ctx.getContext("2d");
    const gradient = axt.createLinearGradient(20, 0, 220, 0);
    gradient.addColorStop(0, "green");
    gradient.addColorStop(0.5, "cyan");

    axt.fillStyle = gradient;
    axt.fillRect(20, 20, 200, 100);

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          backgroundColor: '#285C5B',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
@stop
