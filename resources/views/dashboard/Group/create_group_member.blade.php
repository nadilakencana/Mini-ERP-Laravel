@extends('layoute.latoute')
@section('content')
<div class="card-content-display">
    <div class="header-display">
        <p class="text-tittle">
          New Group Member
        </p>
    </div>
    <div class="form-p-input">
        <form action="{{ route('post_member')}}" method="post">
            @csrf
            <div class="col-form-p-input">
                <label for="nama-barang">Group</label>
                <select class="input-f @error('fid_group') is-invalid @enderror" name="fid_group" >
                    <option value="">-- Pilih Asset Type --</option>
                    @foreach($group as $gp)
                    @if (old('fid_group') == $gp->id)
                    <option value="{{ $gp-> id }}" selected>
                        {{ $gp -> nama_toko }}
                    </option>
                    @else
                    <option value="{{ $gp -> id }}">
                        {{ $gp -> nama_toko}}
                    </option>
                    @endif
                    @endforeach
                </select>
                @error('fid_group')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-form-p-input">
                <label for="nama-barang">Admin</label>
                <select class="input-f @error('fid_user') is-invalid @enderror" name="fid_user" >
                    <option value="">-- Pilih Asset Type --</option>
                    @foreach($user as $admin)
                    @if (old('fid_user') == $admin->id)
                    <option value="{{ $admin-> id }}" selected>
                        {{ $admin -> nama }}
                    </option>
                    @else
                    <option value="{{ $admin -> id }}">
                        {{ $admin -> nama}}
                    </option>
                    @endif
                    @endforeach
                </select>
                @error('fid_group')
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
