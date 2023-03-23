@extends('layoute.latoute')
@section('content')
<div class="card-content-display">
    <div class="header-display">
        <p class="text-tittle">
         Edit Data Supplier
        </p>
    </div>
    <div class="form-p-input">
        <form action="{{ route('update-suplier', encrypt($sp->id) ) }}" method="post">
            @csrf
            <div class="col-form-p-input">
                <label for="kode-barang">Nama Supplier</label>
                <input type="text" name="nama_supplier" class="input-f @error('nama_toko') is-invalid @enderror" placeholder="Nama Supplier" value="{{ $sp-> nama_supplier}}">
                @error('nama_supplier')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-form-p-input">
                <label for="description">Alamat</label>
                <textarea name="alamat" id="" cols="30" rows="10" class="input-f @error('alamat') is-invalid @enderror">{{ $sp-> alamat}}</textarea>
                @error('alamat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">No Telephone</label>
                <input type="text" name="no_hp" class="input-f @error('no_hp') is-invalid @enderror" placeholder="No Telephone" value="{{ $sp-> no_hp}}">
                @error('no_hp')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Email</label>
                <input type="email" name="email" class="input-f @error('email') is-invalid @enderror" placeholder="Email" value="{{ $sp-> email}}">
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">NPWP</label>
                <input type="text" name="npwp" class="input-f @error('npwp') is-invalid @enderror" placeholder="Npwp" value="{{ $sp-> npwp}}">
                @error('npwp')
                <small class="text-danger">{{ $message }}</small>
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
