@extends('layoute.latoute')
@section('content')
<div class="card-content-display">
    <div class="header-display">
        <p class="text-tittle">
          Edit Product
        </p>
    </div>
    <div class="form-p-input">
        <form action="{{ route('update-barang',  encrypt( $barang->id)) }}" method="post">
            @csrf
            <div class="col-form-p-input">
                <label for="kode-barang">Kode Barang</label>
                <input type="text" class="input-f @error('kode') is-invalid @enderror" placeholder="kode barang" name="kode" value="{{ $barang->kode }}">
                @error('kode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Nama Barang</label>
                <input type="text" class="input-f @error('nama_barang') is-invalid @enderror" placeholder="Nama Barang" name="nama_barang" value="{{ $barang->nama_barang }}">
                @error('nama_barang')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Jenis Barang</label>
                <select class="input-f @error('fid_jenis_barang ') is-invalid @enderror" name="fid_jenis_barang" >
                    <option value="{{ $barang-> fid_jenis_barang }}" selected>
                        {{ $barang->jenis->nama_jenis }}
                    </option>
                    @foreach( $jenis_barang as $jenis)
                        @if (old('fid_jenis_barang') == $jenis->id)
                        <option value="{{ $jenis-> id }}" selected>
                            {{ $jenis -> nama_jenis }}
                        </option>
                        @else
                        <option value="{{ $jenis -> id }}">
                            {{$jenis -> nama_jenis}}
                        </option>
                        @endif
                    @endforeach
                </select>
                @error('fid_jenis_barang')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Harga Barang</label>
                <input type="text" class="input-f @error('harga') is-invalid @enderror" placeholder="Harga Barang" name="harga" value="{{ $barang->harga }}">
                @error('harga')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-form-p-input" style="gap:10px">
                <label for="nama-barang">Barang Sendiri</label>
                <input type="checkbox" id="checkbox" class="input-f checkbox @error('produk_sendiri') is-invalid @enderror" name="produk_sendiri" value="{{ $barang->produk_sendiri }}" checked>
                <span>YA</span>
                @error('produk_sendiri')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="button-action-form">
                <button type="submit"><div class="btn-save-form">Save</div></button>
                <a href="{{ url()->previous() }}">
                    <div class="btn-cencel-form">Cancel</div>
                </a>
             </div>
        </form>
    </div>

</div>
@stop
@section('script')
<script>
    $(()=>{
        $('#checkbox').on('click',function(){
            var $elm = $(this);
            $('#checkbox').prop('checked', true)
            if($elm.prop('checked')){
                 $elm.val(1);
            }else{
                $elm.val(0);
            }
            console.log($(this).val());
       });
    })
</script>
@stop
