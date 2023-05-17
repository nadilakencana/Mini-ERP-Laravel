<div class="container-popup-card-product close-hide">
    <div class="card-position ">
        <div class="card-create-customer alias-Product close-hide" style="width: 885px;">
            <div class="header-card-create">
                <p class="text-tittle">
                  Alias Product
                </p>
                <p class="close close-pop"> X </p>
            </div>
           <div class="action">
                <div class="box-search">
                    <div class="icon-search">
                        <img src="{{ asset('Assets/icon/🦆 icon _search_.png') }}" alt="" srcset="">
                    </div>
                    <p>Search</p>
                </div>

                {{--  <div class="button-create" style="margin-right: 0;">
                    <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                    <p>New Product</p>
                </div>  --}}
           </div>
           <div class="tbl-product">
                <div class="table-data">
                    @php $no=1; @endphp
                    <table>
                        <tr class="header-table">
                            <th class="header-row" >No</th>
                            <th class="header-row" style="width:200px">Kode Barang/Jasa</th>
                            <th class="header-row" style="width:302px">Nama Barang/Jasa</th>
                            <th class="header-row" style="width:177px">Alias</th>
                            <th class="header-row" style="width:234px">Harga</th>
                            <th class="header-row" style="width:200px">Action</th>
                        </tr>
                        <tr class="body-table" itemid="1">
                                <td class="body-row">{{ $no++ }}</td>
                                <td class="body-row">MJ007</td>
                                <td class="body-row">Meja Gaming</td>
                                <td class="body-row">Meja </td>
                                <td class="body-row">GF</td>
                                <td class="body-row">data</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="btn-footer">
                <div class="btn-ok" data-item="">
                    Ok
                </div>
            </div>
        </div>
        {{--  form create   --}}
        <div class="card-create-customer alias-product close-hide">
            <div class="header-card-create">
                <p class="text-tittle">
                    New Alias Product
                </p>
                <p class="close"> X </p>
            </div>
            <div class="form-card">
                <form action="">
                    <div class="col-form-p-input barang">
                        <label for="nama-barang">Product Master</label>
                        <select class="input-f " name="fid_barang" id="barang">
                            <option class="old-barang" value="" selected>
                                --pilih Master Barang--
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
                    <div class="col-form-p-input group">
                        <label for="nama-barang">Group </label>
                        <select class="input-f @error('fid_group') is-invalid @enderror" name="fid_group" id="group">
                            <option class="old-group" value="" selected>
                                --pilih Group---
                            </option>
                            @foreach( $group as $gp)
                                @if (old('fid_group') == $gp->id)
                                <option value="{{ $gp-> id }}" selected>
                                    {{ $gp -> nama_toko }}
                                </option>
                                @else
                                <option value="{{ $gp -> id }}">
                                    {{$gp -> nama_toko}}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-form-p-input alias">
                        <label for="nama-barang">Alias Product</label>
                        <input type="text" class="input-f" placeholder="Nama Product Alias">
                    </div>
                    <div class="col-form-p-input harga">
                        <label for="nama-barang">Harga</label>
                        <input type="text" class="input-f" placeholder="Harga Alias">
                    </div>

                    <div class="button-action-form">
                        <div class="btn-save-form">Save</div>
                        <div class="btn-cencel-form">Cancel</div>
                    </div>
                </form>
            </div>
        </div>
        {{--  form create jenis  --}}
        <div class="card-create-customer jenis-product close-hide">
            <div class="header-card-create">
                <p class="text-tittle">
                    New Jenis Product
                </p>
                <p class="close"> X </p>
            </div>
            <div class="form-card">
                <div class="col-form-p-input jenis">
                    <label for="nama-barang">Jenis Product</label>
                    <input type="text" class="input-f" placeholder="Jenis Product">
                </div>
                <div class="button-action-form">
                    <div class="btn-save-form">Save</div>
                    <div class="btn-cencel-form">Cancel</div>
                </div>
            </div>
        </div>

        {{--  form product  --}}
        <div class="card-create-customer product close-hide">
            <div class="header-card-create">
                <p class="text-tittle">
                 New Master Barang
                </p>
                <p class="close close-pop"> X </p>
            </div>
            <span class="note">Pastikan penambahan barang bukan barang custom</span>
            <form action="{{ route('post-barang') }}" method="post">
                @csrf
                <div class="col-form-p-input">
                    <label for="kode-barang">Kode Barang</label>
                    <input type="text" class="input-f @error('kode') is-invalid @enderror" placeholder="kode barang" name="kode">
                    @error('kode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-form-p-input">
                    <label for="nama-barang">Nama Barang</label>
                    <input type="text" class="input-f @error('nama_barang') is-invalid @enderror" placeholder="Nama Barang" name="nama_barang">
                    @error('nama_barang')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-form-p-input">
                    <label for="nama-barang">Jenis Barang</label>
                    <select class="input-f @error('fid_jenis_barang ') is-invalid @enderror" name="fid_jenis_barang" >
                        <option value="">-- Pilih Jenis Barang --</option>
                        @foreach( $jenis_barang as $jenis)
                            @if (old('fid_jenis_barang') == $jenis->id)
                            <option value="{{ $jenis-> id }}" selected>
                                {{ $jenis -> nama_jenis }}
                            </option>
                            @else
                            <option value="{{ $jenis -> id }}">
                                {{$jenis -> nama_jenis}}
                            </option>
                            @endif
                        @endforeach
                    </select>
                    @error('fid_jenis_barang')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-form-p-input">
                    <label for="nama-barang">Harga Barang</label>
                    <input type="text" class="input-f @error('harga') is-invalid @enderror" placeholder="Harga Barang" name="harga">
                    @error('harga')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-form-p-input" style="gap:10px">
                    <label for="nama-barang">Barang Sendiri</label>
                    <input type="checkbox" id="checkbox" class="input-f checkbox @error('produk_sendiri') is-invalid @enderror" name="produk_sendiri" value="0">
                    <span>YA</span>
                    @error('produk_sendiri')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-form-p-input" style="gap:10px">
                    <label for="nama-barang">Buat Alias Barang</label>
                    <input type="checkbox" id="checkbox" class="input-f checkbox alis ">
                    <span>YA</span>
                </div>
                <div class="button-action-form">
                    <div class="btn-save-form">Save</div>
                    <a href="#">
                        <div class="btn-cencel-form">Cancel</div>
                    </a>
                 </div>
            </form>

        </div>
    </div>
</div>
