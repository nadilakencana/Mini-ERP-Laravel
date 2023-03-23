<div class="container-popup-card-create close-hide">
    <div class="card-position">
        {{--  form user edit  --}}
        <div class="card-create-customer user close-hide">
            <div class="header-card-create">
                <p class="text-tittle">
                   Edit Data Admin
                </p>
                <p class="close"> X </p>
            </div>
            <div class="form-card">
                <form action="{{ route('admin-edit', encrypt($edit_user->id)) }}" method="post">
                    @csrf
                    <div class="col-form-p-input">
                        <label for="kode-barang">Username</label>
                        <input type="text" class="input-f @error('username') is-invalid @enderror" name="username" placeholder="username" value="{{  $edit_user->username }}">
                        @error('username')
                        <small class="text-danger">{{ $message }}</small>
                         @enderror
                    </div>
                    <div class="col-form-p-input">
                        <label for="kode-barang">Nama</label>
                        <input type="text" class="input-f @error('nama') is-invalid @enderror" name="nama" placeholder="Nama Admin" value="{{  $edit_user->nama }}">
                        @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                         @enderror
                    </div>
                    <div class="col-form-p-input">
                        <label for="kode-barang">Email</label>
                        <input type="email" class="input-f @error('email') is-invalid @enderror" name="email" placeholder="email user" value="{{  $edit_user->email }}">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                         @enderror
                    </div>
                    <div class="col-form-p-input">
                        <label for="kode-barang">No Telephone</label>
                        <input type="number" class="input-f @error('no_hp') is-invalid @enderror" name="no_hp" placeholder="no handphone" value="{{  $edit_user->no_hp }}">
                        @error('no_hp')
                        <small class="text-danger">{{ $message }}</small>
                         @enderror
                    </div>
                    {{--  <div class="col-form-p-input">
                        <label for="kode-barang">Password</label>
                        <input type="password" class="input-f @error('password') is-invalid @enderror" name="password" placeholder="no handphone" value="{{  $edit_user->password }}">
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                         @enderror
                    </div>  --}}

                    <div class="col-form-p-input">
                        <label for="nama-barang">Role</label>
                       <select name="role"  class="input-f" >
                            @foreach ($user_role as $Ur)
                            <option value="{{ $Ur->id }}" selected>
                                {{ $Ur -> nama_role}}
                            </option>
                                @if(old('id') == $Ur->id)
                                    <option value="{{ $Ur->id }}" selected>
                                        {{ $Ur -> nama_role}}
                                    </option>
                                @else
                                <option value="{{ $Ur->id }}">
                                    {{ $Ur -> nama_role}}
                                </option>
                                @endif
                            @endforeach
                       </select>
                    </div>
                    <div class="button-action-form">
                       <button type="submit"> <div class="btn-save-form">Save</div></button>
                        <div class="btn-cencel-form">Cancel</div>
                    </div>
                </form>
            </div>
        </div>

        {{--  form edit update role  --}}
        <div class="card-create-customer role close-hide">
            <div class="header-card-create">
                <p class="text-tittle">
                   Edit Data Admin
                </p>
                <p class="close"> X </p>
            </div>
            <div class="form-card">
                {{--  <form action="">  --}}
                    <div class="col-form-p-input jabatan">
                        <label for="kode-barang">Nama Jabatan</label>
                        <input type="text" class="input-f" placeholder="Nama jabatan">
                    </div>
                    <div class="col-form-p-input level">
                        <label for="kode-barang">Level</label>
                        <input type="text" class="input-f" placeholder="level">
                    </div>

                    <div class="button-action-form">
                        <div class="btn-save-form">Save</div>
                        <div class="btn-cencel-form">Cancel</div>
                    </div>
                {{--  </form>  --}}
            </div>
        </div>
    </div>

</div>
