@extends('layoute.latoute')
@section('content')
<div class="card-content-display">
    <div class="header-display">
        <p class="text-tittle">
          New Group
        </p>
    </div>
    <div class="form-p-input">
        <form action="{{ route('createdatagroup') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-form-p-input">
                <label for="kode-barang">Nama Group</label>
                <input type="text" class="input-f @error('nama_toko') is-invalid @enderror" name="nama_toko" placeholder="Nama Group/Toko" required>
                @error('nama_toko')
                <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
            <div class="col-form-p-input">
                <label for="kode-barang">Kode Invoice</label>
                <input type="text" class="input-f @error('kode_invoice') is-invalid @enderror" name="kode_invoice" placeholder="Kode Invoice" required>
                @error('kode_invoice')
                <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
            <div class="col-form-p-input">
                <label for="description">Alamat</label>
                <textarea name="alamat" id="" cols="30" rows="10" class="input-f @error('alamat') is-invalid @enderror" required></textarea>
                @error('alamat')
                <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">No Telephone</label>
                <input type="text" name="no_telpon" class="input-f @error('no_telpon') is-invalid @enderror" placeholder="No Telephone">
                @error('no_telpon')
                <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Logo Toko</label>
                <input type="file" name="logo_toko" class="input-f @error('logo_toko') is-invalid @enderror" placeholder="logo">
                @error('logo_toko')
                <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Shoppe</label>
                <input type="text" name="shoppee_hook" class="input-f @error('shoppee_hook') is-invalid @enderror" placeholder="Key Shoppe">
                @error('shoppee_hook')
                <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Tokopedia</label>
                <input type="text" name="tokopedia_hook" class="input-f @error('tokopedia_hook') is-invalid @enderror" placeholder="Key Tokopedia">
                @error('tokopedia_hook')
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
