@extends('layoute.latoute')
@section('content')
@include('dashboard.part-lain.popUp_Create_customer')
<div class="card-content-display">
    <div class="header-display">
        <p class="text-tittle">
          New Customer
        </p>
    </div>
    <div class="form-p-input">
        <form action="{{ route('post-data-customer') }}" method="post">
            @csrf
            <div class="col-form-p-input">
                <label for="kode-barang">Nama Customer</label>
                <input type="text" name="nama_customer" class="input-f @error('nama_customer') is-invalid @enderror" placeholder="Nama Customer" required>
                @error('nama_customer')
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
                <input type="number" name="no_hp" class="input-f @error('no_hp') is-invalid @enderror" placeholder="No Telephone" required>
                @error('no_hp')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Email</label>
                <input type="email" name="email" class="input-f @error('email') is-invalid @enderror" placeholder="Email" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">NPWP</label>
                <input type="text" name="npwp" class="input-f @error('npwp') is-invalid @enderror" placeholder="Npwp" required>
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
