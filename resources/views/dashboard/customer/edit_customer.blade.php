@extends('layoute.latoute')
@section('content')
<div class="card-content-display">
    <div class="header-display">
        <p class="text-tittle">
          Edit Data Customer
        </p>
    </div>
    <div class="form-p-input">
        <form action="{{ route('update-data-customer', encrypt($customer->id)) }}" method="post">
            @csrf
            <div class="col-form-p-input">
                <label for="kode-barang">Nama Customer</label>
                <input type="text" name="nama_customer" class="input-f @error('nama_customer') is-invalid @enderror" placeholder="Nama Customer" value="{{ $customer->nama_customer }}" required>
                @error('nama_customer')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-form-p-input">
                <label for="description">Alamat</label>
                <textarea name="alamat" id="" cols="30" rows="10" class="input-f @error('alamat') is-invalid @enderror">{{ $customer->alamat }}</textarea>
                @error('alamat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">No Telephone</label>
                <input type="number" name="no_hp" class="input-f @error('no_hp') is-invalid @enderror" placeholder="No Telephone" value="{{ $customer->no_hp }}" required>
                @error('no_hp')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Email</label>
                <input type="email" name="email" class="input-f @error('email') is-invalid @enderror" placeholder="Email" value="{{ $customer->email }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">NPWP</label>
                <input type="text" name="npwp" class="input-f @error('npwp') is-invalid @enderror" placeholder="Npwp" value="{{ $customer->npwp }}" required>
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
@stop
