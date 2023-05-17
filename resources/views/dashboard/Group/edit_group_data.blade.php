@extends('layoute.latoute')
@section('content')
<div class="card-content-display">
    <div class="header-display">
        <p class="text-tittle">
          Edit Group
        </p>
    </div>
    <div class="form-p-input">
        <form action="{{ route('updatedatagroup', encrypt($grp->id)) }}" method="post" enctype="multipart/form-data">
            @csrf
            {{--  @method("PUT")  --}}
            <div class="col-form-p-input">
                <label for="kode-barang">Nama Group</label>
                <input type="text" class="input-f @error('nama_toko') is-invalid @enderror" name="nama_toko" placeholder="Nama Group/Toko" value="{{ $grp->nama_toko }}" required>
                @error('nama_toko')
                <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
            <div class="col-form-p-input">
                <label for="kode-barang">Kode Invoice</label>
                <input type="text" class="input-f @error('kode_invoice') is-invalid @enderror" name="kode_invoice" placeholder="Kode Invoice" value="{{ $grp->kode_invoice }}" required>
                @error('kode_invoice')
                <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
            <div class="col-form-p-input">
                <label for="description">Alamat</label>
                <textarea name="alamat" id="" cols="30" rows="10" class="input-f @error('alamat') is-invalid @enderror" required>{{ $grp->alamat }}</textarea>
                @error('alamat')
                <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">No Telephone</label>
                <input type="text" name="no_telpon" class="input-f @error('no_telpon') is-invalid @enderror" placeholder="No Telephone" value="{{ $grp->no_telpon }}">
                @error('no_telpon')
                <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Rekening Non PPN</label>
                <input type="text" name="rekening_no_ppn" class="input-f @error('rekening_no_ppn') is-invalid @enderror" placeholder="Nama Bank, Nama Pemilik, No Rekening" value="{{ $grp->rekening_no_ppn }}">
                @error('rekening_no_ppn')
                <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Rekening PPN</label>
                <input type="text" name="rekening_ppn" class="input-f @error('rekening_ppn') is-invalid @enderror" placeholder="Nama Bank, Nama Pemilik, No Rekening" value="{{ $grp->rekening_ppn }}">
                @error('rekening_ppn')
                <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Logo Toko</label>
                <input type="file" name="logo_toko" class="input-f @error('logo_toko') is-invalid @enderror" placeholder="logo" value="{{ $grp->logo_toko }}">
                @error('logo_toko')
                <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Shoppe</label>
                <input type="text" name="shoppee_hook" class="input-f @error('shoppee_hook') is-invalid @enderror" placeholder="Key Shoppe" value="{{ $grp->shoppee_hook }}">
                @error('shoppee_hook')
                <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Tokopedia</label>
                <input type="text" name="tokopedia_hook" class="input-f @error('tokopedia_hook') is-invalid @enderror" placeholder="Key Tokopedia" value="{{ $grp->tokopedia_hook }}">
                @error('tokopedia_hook')
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
