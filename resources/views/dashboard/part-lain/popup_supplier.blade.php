<div class="container-popup-card-create close-hide">
    <div class="card-position">
     
        {{--  form create contact detail customer  --}}
        <div class="card-create-customer cp-supplier close-hide">
            <div class="header-card-create">
                <p class="text-tittle">
                    New Contact Supplier
                </p>
                <p class="close"> X </p>
            </div>
            <div class="form-card">
                {{--  <form action="">  --}}
                    <div class="col-form-p-input supplier">
                        <label for="nama-barang">Supplier</label>
                        <select class="input-f @error('fid_supplier') is-invalid @enderror" name="fid_supplier" id="supplier">
                            <option class="old-suplier" value="" selected>
                                Pilih Supplier
                            </option>
                            @foreach( $suplier  as $sp)
                                @if (old('fid_supplier') == $sp->id)
                                <option value="{{$sp->id }}" selected>
                                    {{ $sp->nama_supplier }}
                                </option>
                                @else
                                <option value="{{ $sp->id }}">
                                    {{$sp->nama_supplier}}
                                </option>
                                @endif
                            @endforeach
                        </select>
                        @error('fid_supplier')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-form-p-input namaLengkap">
                        <label for="nama-barang">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="input-f @error('nama_lengkap') is-invalid @enderror" placeholder="nama lengkap customer">
                        @error('nama_lengkap')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-form-p-input jabatan">
                        <label for="nama-barang">Jabatan</label>
                        <input type="text" name="jabatan" class="input-f @error('jabatan') is-invalid @enderror" placeholder="jabatan customer">
                        @error('jabatan')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-form-p-input departemen">
                        <label for="nama-barang">Departement</label>
                        <input type="text" name="departemen" class="input-f @error('departemen') is-invalid @enderror" placeholder="departement customer">
                        @error('departemen')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-form-p-input email">
                        <label for="nama-barang">Email</label>
                        <input type="email" name="email" class="input-f @error('email') is-invalid @enderror" placeholder="email customer">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-form-p-input noHp">
                        <label for="nama-barang">No Telephone</label>
                        <input type="number" name="no_hp" class="input-f @error('no_hp') is-invalid @enderror" placeholder="No Telephone">
                        @error('no_hp')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="button-action-form">
                        <button type="submit"><div class="btn-save-form">Save</div></button>
                        <div class="btn-cencel-form">Cancel</div>
                    </div>
                {{--  </form>  --}}
            </div>
        </div>

        {{--  show data detail  --}}
        <div class="card-create-customer detail-data supplier close-hide" style="width: 510px;">
            <div class="header-card-create">
                <p class="text-tittle">
                    Detail Contact Supplier
                </p>
                <p class="close"> X </p>
            </div>
            <div class="card-detail-data">
                <div class="detail-data">
                    <div class="atribut">
                        Nama Supplier
                    </div>
                    <div class="v-data name-supplier">
                        : Kantor DJP
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
                    <div class="v-data departemen">
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
