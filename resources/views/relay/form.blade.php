<x-modal data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        Tambah Data
    </x-slot>

    @method('POST')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="merk">Merk Kendaran</label>
                <input id="merk" class="form-control" type="text" name="merk" autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="plat_number">Nomor Plat Kendaran</label>
                <input id="plat_number" class="form-control" type="text" name="plat_number" autocomplete="off"
                    required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="name_of_the_owner">Nama Pemilik Kendaran</label>
                <input id="name_of_the_owner" class="form-control" type="text" name="name_of_the_owner"
                    autocomplete="off" required>
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <button type="button" onclick="submitForm(this.form)" class="btn btn-sm btn-primary" id="submitBtn">
            <span id="spinner-border" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <i class="fas fa-save mr-1"></i>
            Simpan</button>
    </x-slot>
</x-modal>
