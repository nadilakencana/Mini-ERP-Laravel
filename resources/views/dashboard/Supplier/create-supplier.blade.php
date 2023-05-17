@extends('layoute.latoute')
@section('content')
<div class="card-content-display">
    <div class="header-display">
        <p class="text-tittle">
          New Supplier
        </p>
    </div>
    <div class="form-p-input">
        <form action="{{ route('post-suplier') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-form-p-input">
                <label for="kode-barang">Nama Supplier</label>
                <input type="text" class="input-f @error('nama_supplier') is-invalid @enderror" name="nama_supplier" placeholder="Nama supplier" required>
                @error('nama_supplier')
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
                <input type="text" name="no_hp" class="input-f @error('no_hp') is-invalid @enderror" placeholder="No Telephone">
                @error('no_hp')
                <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Email</label>
                <input type="email" name="email" class="input-f @error('email') is-invalid @enderror" placeholder="email supplier">
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">NPWP</label>
                <input type="text" name="npwp" class="input-f @error('npwp') is-invalid @enderror" placeholder="npwp supplier">
                @error('npwp')
                <small class="text-danger">{{ $message }}</small>
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
@endsection
