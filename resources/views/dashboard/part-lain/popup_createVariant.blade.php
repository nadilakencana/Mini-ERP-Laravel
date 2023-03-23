<div class="container-popup-card-variasi  close-hide">
    <div class="card-position ">
        <div class="card-create-product">
            <div class="header-card-create">
                <p class="text-tittle">
                    New Varian
                </p>
                <p class="close-create" style="cursor: pointer"> X </p>
            </div>
            <div class="form-card">
                <div class="col-form-p-input varian">
                    <label for="kode-barang">Nama Varian</label>
                    <input type="text" class="input-f" placeholder="Nama Varian" name="nama_varian">
                </div>
                <div class="col-form-p-input">
                        <label for="nama-barang">Product Master</label>
                        <select class="input-f " name="fid_barang" id="barang">
                            <option class="old-barang" value="" selected>

                            </option>
                            @foreach( $product as $barang)
                                @if (old('fid_barang') ==  $barang->id)
                                <option value="{{  $barang-> id }}" selected>
                                    {{ $barang -> nama_barang }}
                                </option>
                                @else
                                <option value="{{  $barang  -> id }}">
                                    {{ $barang  -> nama_barang}}
                                </option>
                                @endif
                            @endforeach
                        </select>
                </div>
                <div class="button-action-form">
                    <div class="btn-save-form">Save</div>
                    <div class="btn-cencel-form">Cancel</div>
                </div>
            </div>
        </div>
    </div>
</div>
