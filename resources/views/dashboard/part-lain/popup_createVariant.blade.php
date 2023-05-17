<div class="container-popup-card-variasi  close-hide">
    <div class="card-position ">
        <div class="card-create-product create">
            <div class="header-card-create">
                <p class="text-tittle">
                    New Varian
                </p>
                <p class="close-create" style="cursor: pointer"> X </p>
            </div>
            <div class="form-card">
                <div class="col-form-p-input barang">
                    <label for="nama-barang">Jenis Barang</label>
                    <select class="input-f " name="fid_jenis_barang" id="barang">
                        <option class="old-barang" value="" selected>
                            --Pilih Jenis Barang--
                        </option>
                        @foreach( $jenis_barang as $jenis)
                            @if (old('fid_jenis_barang') ==  $jenis->id)
                            <option class="item-barang" value="{{  $jenis-> id }}" selected>
                                {{ $jenis -> nama_jenis }}
                            </option>
                            @else
                            <option class="item-barang" value="{{  $jenis  -> id }}">
                                {{ $jenis  -> nama_jenis}}
                            </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-form-p-input varian">
                    <label for="kode-barang">Nama Varian</label>
                    <input type="text" id="input-tags" class="demo-default selectized"  placeholder="Nama Varian" name="nama_varian" >
                </div>

                <div class="button-action-form">
                    <div class="btn-save-form">Save</div>
                    <div class="btn-cencel-form">Cancel</div>
                </div>
            </div>
        </div>
        <div class="card-create-product edit close-hide">
            <div class="header-card-create">
                <p class="text-tittle">
                    Edit Varian
                </p>
                <p class="close-create" style="cursor: pointer"> X </p>
            </div>
            <div class="form-card edit">
                <div class="col-form-p-input">
                    <label for="nama-barang">Jenis Barang</label>
                    <select class="input-f " name="fid_jenis_barang" id="barang">
                        <option class="old-barang" value="" selected>

                        </option>
                        @foreach( $jenis_barang as $jenis)
                            @if (old('fid_jenis_barang') ==  $jenis->id)
                            <option class="item-barang" value="{{  $jenis-> id }}" selected>
                                {{ $jenis -> nama_jenis }}
                            </option>
                            @else
                            <option class="item-barang" value="{{  $jenis  -> id }}">
                                {{ $jenis  -> nama_jenis}}
                            </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-form-p-input varian">
                    <label for="kode-barang">Nama Varian</label>
                    <input type="text"  class="input-f"  placeholder="Nama Varian" name="nama_varian" >
                </div>

                <div class="button-action-form">
                    <div class="btn-save-form">Save</div>
                    <div class="btn-cencel-form">Cancel</div>
                </div>
            </div>
        </div>
    </div>
</div>
