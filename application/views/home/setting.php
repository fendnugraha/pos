<div class="container">
    <div class="row mt-4">
        <div class="col-sm">
            <div class="card">
                <h5 class="card-header">Setting Cetak Struk</h5>
                <div class="card-body">
                    <form action="<?= base_url('home/update_setting'); ?>" method="post">
                        <div class="mb-3">
                            <label for="namakonter" class="form-label">Nama Konter</label>
                            <input type="text" name="namakonter" id="namakonter" class="form-control form-control-sm" value="<?= $setting['namakonter']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control form-control-sm" value="<?= $setting['alamat']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" name="telepon" id="telepon" class="form-control form-control-sm" value="<?= $setting['telepon']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="saldoawal" class="form-label">Saldo Awal</label>
                            <input type="number" name="saldoawal" id="saldoawal" class="form-control form-control-sm" value="<?= $setting['saldoawal']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="akhirkata" class="form-label">Akhir Kata</label>
                            <input type="text" name="akhirkata" id="akhirkata" class="form-control form-control-sm" value="<?= $setting['akhirkata']; ?>">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-7">

        </div>
    </div>

    <!-- <div class="row mt-4">
        <div class="col-sm">
            <div class="card">
                <div class="card-header">
                    Rekap Transaksi
                </div>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div> -->
</div>