<div class="main-page overflow-y-auto">
    <div class="card" style="height: 100%;">
        <div class="card-body overflow-x-auto">
            <form action="<?= base_url('home/update_setting'); ?>" method="post">
                <div class="row mb-3">
                    <div class="col-sm">
                        <label for="namakonter" class="form-label">Nama Konter</label>
                        <input type="text" name="namakonter" id="namakonter" class="form-control form-control-sm" value="<?= $setting['namakonter']; ?>">
                    </div>
                    <div class="col-sm-3">
                        <label for="prefik" class="form-label">Kode</label>
                        <input type="text" name="prefik" id="prefik" class="form-control form-control-sm" value="<?= $setting['prefik']; ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control form-control-sm" value="<?= $setting['alamat']; ?>">
                </div>
                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="text" name="telepon" id="telepon" class="form-control form-control-sm" value="<?= $setting['telepon']; ?>">
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="saldoawal" class="form-label">Saldo Awal IRS</label>
                        <input type="number" name="saldoawal" id="saldoawal" class="form-control form-control-sm" value="<?= $setting['saldoawal']; ?>">
                    </div>
                    <div class="col mb-3">
                        <label for="saldoawalok" class="form-label">Saldo Awal OKELINK</label>
                        <input type="number" name="saldoawalok" id="saldoawalok" class="form-control form-control-sm" value="<?= $setting['saldoawalok']; ?>">
                    </div>
                    <div class="col mb-3">
                        <label for="kasawal" class="form-label">Kas Awal</label>
                        <input type="number" name="kasawal" id="kasawal" class="form-control form-control-sm" value="<?= $setting['kasawal']; ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="akhirkata" class="form-label">Akhir Kata</label>
                    <input type="text" name="akhirkata" id="akhirkata" class="form-control form-control-sm" value="<?= $setting['akhirkata']; ?>">
                </div>
                <div class="mb-3">
                    <label for="manager" class="form-label">Manager</label>
                    <input type="text" name="manager" id="manager" class="form-control form-control-sm" value="<?= $setting['manager']; ?>">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>