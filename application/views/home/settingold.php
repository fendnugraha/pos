<div class="container">
    <div class="row mt-4">
        <div class="col-sm">
            <div class="card">
                <h5 class="card-header">Setting Cetak Struk</h5>
                <div class="card-body">
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
                        <div class="row">
                            <div class="col mb-3">
                                <label for="cash_account_id" class="form-label">Cash Account ID</label>
                                <input type="text" name="cash_account_id" id="cash_account_id" class="form-control form-control-sm" value="<?= $setting['cash_account_id']; ?>">
                            </div>
                            <div class="col mb-3">
                                <label for="pr_start" class="form-label">Periode Awal</label>
                                <input type="text" name="pr_start" id="pr_start" class="form-control form-control-sm" value="<?= $setting['pr_start']; ?>">
                            </div>
                            <div class="col mb-3">
                                <label for="pr_end" class="form-label">Periode Akhir</label>
                                <input type="text" name="pr_end" id="pr_end" class="form-control form-control-sm" value="<?= $setting['pr_end']; ?>">
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
        <div class="col-sm-7">
            <div class="card mb-3">
                <h5 class="card-header">Tambah Agen</h5>
                <div class="card-body">
                    <form action="<?= base_url('home/tambahagen'); ?>" method="post">
                        <div class="mb-3">
                            <label for="idagen" class="form-label">ID Agen</label>
                            <input type="text" name="idagen" id="idagen" class="form-control form-control-sm" value="">
                        </div>
                        <div class="mb-3">
                            <label for="namaagen" class="form-label">Nama Agen</label>
                            <input type="text" name="namaagen" id="namaagen" class="form-control form-control-sm" value="">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Account Code</th>
                        <th>Account Name</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $accountlist = $accountlist['accounts'][0]['children'];
                    foreach ($accountlist as $ac) {
                    ?>
                        <tr>
                            <td><?= $ac['account']['id']; ?></td>
                            <td><?= $ac['account']['number']; ?></td>
                            <td><?= $ac['account']['name']; ?></td>
                            <td><?= $ac['account']['description']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
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