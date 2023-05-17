@foreach ($Penjualan->Detailpenjualan as $k => $DetailPenjualan )
<tr class="body-table" itemid="{{ $k }}">
    <td class="body-row input-row" data-row="{{ $k }}">
        <div class="part-input alias">
            <input type="text" class="input-tbl product" data-id="{{ $k }}" value="{{ $DetailPenjualan->product->alias }}">
            <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="" class="input-icon" data-id="{{ $k }}">
        </div>
     </td>
     <td class="body-row input-row variasi" data-row="{{$k}}">
        <select name= "productPembelian[{{ $k }}][variasi]" data-id="{{ $k }}" class="warna">
            {{--  <option value="Hitam" data-id="" class="item-warna">Hitam</option>
            <option value="Putih" data-id="" class="item-warna">Putih</option>
            <option value="Cream" data-id="" class="item-warna">Cream</option>  --}}
        </select>
    </td>
     <td class="body-row input-row desc" data-row="{{$k}}">

        <input type="text" name="productPembelian[{{$k}}][keterangan]"  class="input-tbl dsc" data-id="{{$k}}" value="{{ $DetailPenjualan->keterangan }}">
     </td>
     <td class="body-row input-row qty" data-row="{{$k}}">
        <input type="text" name="productPembelian[{{$k}}][jumlah]" class="input-tbl qty" data-id="{{$k}}" value="{{ $DetailPenjualan->jumlah }}">
     </td>
     <td class="body-row input-row harga_satuan" data-row="{{$k}}">
        <input type="text" name="productPembelian[{{$k}}][harga_satuan]" class="input-tbl unit_price" data-id="{{$k}}"  value="{{ $DetailPenjualan->harga_satuan }}">
     </td>

     <td class="body-row input-row amount" data-row="{{$k}}">
        <input type="text" name="productPembelian[{{$k}}][total]" class="input-tbl amount" data-id="{{$k}}" value="{{ $DetailPenjualan->total }}">
     </td>
     <td class="body-row action-btn" data-id="{{$k}}">
        <div class="icon-plus">
            <img src="{{ asset('Assets/icon/🦆 icon _plus_.png') }}" alt="" srcset="">
        </div>
        <div class="icon-delete" data-id="{{$k}}">
            <img src="{{ asset('Assets/icon/icon _trash_.png') }}" alt="" srcset="">
        </div>
     </td>
</tr>
@endforeach

