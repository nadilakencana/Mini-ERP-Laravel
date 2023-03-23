<div class="container-popup-cd-pembayaran close-hide">
    <div class="card-position">
        <div class="card-create-customer " style="width: 653px;">
            <div class="header-card-create">
                <p class="text-tittle">
                   Pembayaran
                </p>
                <p class="close"> X </p>
            </div>
            <div class="form-card pembayaran">

                {{--  <form action="">  --}}
                    <div class="row-form">
                        {{--  <form action="">  --}}
                            <div class="Purchase-date">
                                <label for="date-purchase">Tanggal</label>
                                <input type="date" name="tanggal" id="date_pembayaran">
                                {{--  <input id="txtId" type="hidden" class="form-control txt">  --}}
                            </div>
                        {{--  </form>  --}}
                        <div class="i-form-sales">
                            <label for="nofaktur">RP</label>
                            <input type="text" name="total" class="i-form jumlah" placeholder="0">
                        </div>
                        <div class="vendor-selection">
                            <label for="vendor">Pembayaran</label>
                            <select name="pembayaran" id="" placeholder="Select pembayaran" class="pembayaran">
                                <option class="metode_pb" value="">--Metode Pembayaran--</option>
                                <option class="metode_pb" value="Trasfer">Tarnsfer</option>
                                <option class="metode_pb" value="Cash">Cash</option>
                                <option class="metode_pb" value="Debit">Debit</option>
                            </select>
                        </div>
                    </div>
                    <div class="row-form">
                        <div class="description">
                            <label for="dsc">Description</label>
                            <textarea name="deskripPembayaran" id="" cols="40" rows="6" class="dsc"></textarea>
                        </div>
                        <div class="btn-tambah-pyment">
                            <div class="btn-pyment">
                                Tambah Pembayaran
                            </div>
                        </div>
                    </div>
                {{--  </form>  --}}

            </div>

            <div class="tbl-pembayaran">
                <table class="tbl">
                    <thead class="tbl-head">
                        <tr class="tr-tbl-payment">
                            <th class="th-tbl-payment">No</th>
                            <th class="th-tbl-payment">Tanggal</th>
                            <th class="th-tbl-payment">Pembayaran</th>
                            <th class="th-tbl-payment">Total</th>
                            <th class="th-tbl-payment" style="width: 157px;">Keterangan</th>
                            <th class="th-tbl-payment">Diperiksa</th>
                        </tr>
                    </thead>
                    <tbody class="tbl-body-payment">
                        <tr class="tbl-tr-body">
                            <td class="tbl-td-body-payment">1</td>
                            <td class="tbl-td-body-payment">data tanggal</td>
                            <td class="tbl-td-body-payment">data pembayaran</td>
                            <td class="tbl-td-body-payment">total data</td>
                            <td class="tbl-td-body-payment">data ket</td>
                            <td class="tbl-td-body-payment">status</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



