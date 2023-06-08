@foreach ($DetailPenjualan as $k => $detail )
<input type="hidden" name="productPembelian[{{ $k }}][alias]" class="input-hide product" value="{{ $detail->fid_barang }}"/>
<input type="hidden" name="productPembelian[{{ $k }}][variasi]" class="input-hide variasi" value="{{ $detail->fid_variasi }}"/>
<input type="hidden" name="productPembelian[{{ $k }}][keterangan]" class="input-hide keterangan" value="{{ $detail->keterangan }}"/>
<input type="hidden" name="productPembelian[{{ $k }}][jumlah]" class="input-hide jumlah" value="{{ $detail->jumlah }}"/>
<input type="hidden" name="productPembelian[{{ $k }}][harga_satuan]" class="input-hide harga_satuan" value="{{ $detail->harga_satuan }}"/>
<input type="hidden" name="productPembelian[{{ $k }}][total]" class="input-hide total" value="{{ $detail->total }}"/>
@endforeach

