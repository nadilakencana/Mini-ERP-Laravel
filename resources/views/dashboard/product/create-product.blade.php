@extends('layoute.latoute')
@section('content')
<div class="card-content-display">
    <div class="header-display">
        <p class="text-tittle">
          New Product
        </p>
    </div>
    <div class="form-p-input">
        <form action="{{ route('post-barang') }}" method="post">
            @csrf
            <div class="col-form-p-input">
                <label for="kode-barang">Kode Barang</label>
                <input type="text" class="input-f @error('kode') is-invalid @enderror" placeholder="kode barang" name="kode">
                @error('kode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Nama Barang</label>
                <input type="text" class="input-f @error('nama_barang') is-invalid @enderror" placeholder="Nama Barang" name="nama_barang">
                @error('nama_barang')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Jenis Barang</label>
                <select class="input-f @error('fid_jenis_barang ') is-invalid @enderror" name="fid_jenis_barang" >
                    <option value="">-- Pilih Jenis Barang --</option>
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
            <div class="button-action-form">
                <button type="submit"><div class="btn-save-form">Save</div></button>
                <div class="btn-cencel-form">Cancel</div>
             </div>
        </form>
    </div>

</div>
@stop
