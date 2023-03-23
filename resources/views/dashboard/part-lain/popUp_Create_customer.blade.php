<div class="container-popup-card-create close-hide">
    <div class="card-position">
        {{--  form create customer  --}}
        <div class="card-create-customer customer close-hide">
            <div class="header-card-create">
                <p class="text-tittle">
                    New  Customer
                </p>
                <p class="close"> X </p>
            </div>
            <div class="form-card">
                {{--  <form action="">  --}}
                    <div class="col-form-p-input customer">
                        <label for="kode-barang">Nama Customer</label>
                        <input type="text" name="nama_customer" class="input-f @error('nama_customer') is-invalid @enderror" placeholder="Nama Customer" required>
                        @error('nama_customer')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-form-p-input alamat-cs">
                        <label for="description">Alamat</label>
                        <textarea name="alamat" id="" cols="30" rows="10" class="input-f @error('alamat') is-invalid @enderror" required></textarea>
                        @error('alamat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-form-p-input hp">
                        <label for="nama-barang">No Telephone</label>
                        <input type="number" name="no_hp" class="input-f @error('no_hp') is-invalid @enderror" placeholder="No Telephone" required>
                        @error('no_hp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-form-p-input email">
                        <label for="nama-barang">Email</label>
                        <input type="email" name="email" class="input-f @error('email') is-invalid @enderror" placeholder="Email" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-form-p-input npwp">
                        <label for="nama-barang">NPWP</label>
                        <input type="text" name="npwp" class="input-f @error('npwp') is-invalid @enderror" placeholder="Npwp" required>
                        @error('npwp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="button-action-form">
                        <div class="btn-save-form">Save</div>
                        <div class="btn-cencel-form">Cancel</div>
                    </div>
                {{--  </form>  --}}
            </div>
        </div>

        {{--  form create contact detail customer  --}}
        <div class="card-create-customer cp-customer close-hide">
            <div class="header-card-create">
                <p class="text-tittle">
                    New Detail Contact Customer
                </p>
                <p class="close"> X </p>
            </div>
            <div class="form-card">
                {{--  <form action="">  --}}
                    <div class="col-form-p-input">
                        <label for="nama-barang">Customer</label>
                        <select class="input-f @error('fid_customer') is-invalid @enderror" name="fid_customer" id="customer">
                            <option class="old-customer" value="" selected>
                                Pilih Name Customer
                            </option>
                            @foreach( $customer  as $cs)
                                @if (old('fid_customer') == $cs->id)
                                <option value="{{$cs->id }}" selected>
                                    {{ $cs->nama_customer }}
                                </option>
                                @else
                                <option value="{{ $cs->id }}">
                                    {{$cs->nama_customer}}
                                </option>
                                @endif
                            @endforeach
                        </select>
                        @error('fid_customer')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                    <div class="col-form-p-input namaLengkap">
                        <label for="kode-barang">Nama Customer</label>
                        <input type="text" name="nama_lengkap" class="input-f @error('nama_lengkap') is-invalid @enderror" placeholder="Nama Customer" required>
                        @error('nama_lengkap')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-form-p-input jabatan">
                        <label for="kode-barang">Jabatan Customer</label>
                        <input type="text" name="jabatan" class="input-f @error('jabatan') is-invalid @enderror" placeholder="Jabatan Customer" required>
                        @error('jabatan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-form-p-input departemen">
                        <label for="kode-barang">Departement Customer</label>
                        <input type="text" name="departement" class="input-f @error('departement') is-invalid @enderror" placeholder="Departement Customer" required>
                        @error('departement')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-form-p-input noHp">
                        <label for="nama-barang">No Telephone</label>
                        <input type="number" name="no_hp" class="input-f @error('no_hp') is-invalid @enderror" placeholder="No Telephone" required>
                        @error('no_hp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-form-p-input email">
                        <label for="nama-barang">Email</label>
                        <input type="email" name="email" class="input-f @error('email') is-invalid @enderror" placeholder="Email" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="button-action-form">
                        <div class="btn-save-form">Save</div>
                        <div class="btn-cencel-form">Cancel</div>
                    </div>
                {{--  </form>  --}}
            </div>
        </div>

        {{--  show data detail  --}}
        <div class="card-create-customer detail-data close-hide" style="width: 510px;">
            <div class="header-card-create">
                <p class="text-tittle">
                    Detail Contact Customer
                </p>
                <p class="close"> X </p>
            </div>
            <div class="card-detail-data">
                <div class="detail-data">
                    <div class="atribut">
                        Nama Customer
                    </div>
                    <div class="v-data name-Customer">
                        :Kantor DJP
                    </div>
                </div>
                <div class="detail-data">
                    <div class="atribut">
                        Nama Lengkap
                    </div>
                    <div class="v-data nama-lengkap">
                       : Nadila
                    </div>
                </div>
                <div class="detail-data">
                    <div class="atribut">
                        Jabatan
                    </div>
                    <div class="v-data jabatan">
                        : PIC
                    </div>
                </div>
                <div class="detail-data">
                    <div class="atribut">
                        Departement
                    </div>
                    <div class="v-data departemen ">
                       : IT Dev
                    </div>
                </div>
                <div class="detail-data">
                    <div class="atribut">
                        Email
                    </div>
                    <div class="v-data email">
                        : Nadilakencana@gmail.com
                    </div>
                </div>
                <div class="detail-data">
                    <div class="atribut">
                        No Telpon
                    </div>
                    <div class="v-data nohp">
                        : 089898989898
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
