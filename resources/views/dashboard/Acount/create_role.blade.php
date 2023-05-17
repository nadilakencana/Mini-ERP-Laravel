<div class="container-popup-card-create close-hide">
    <div class="card-position">
        {{--  form edit update role  --}}
        <div class="card-create-customer role close-hide">
            <div class="header-card-create">
                <p class="text-tittle">
                    Edit Data Role
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
                        <a href="{{ url()->previous() }}">
                            <div class="btn-cencel-form">Cancel</div>
                        </a>
                    </div>
                {{--  </form>  --}}
            </div>
        </div>
    </div>

</div>
