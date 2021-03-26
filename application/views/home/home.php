<div class="container">
    <div class="row mt-4">
        <div class="col-sm">
            <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="desposit-tab" data-bs-toggle="tab" href="#desposit" role="tab" aria-controls="desposit" aria-selected="true">Desposit</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="kaskeluar-tab" data-bs-toggle="tab" href="#kaskeluar" role="tab" aria-controls="kaskeluar" aria-selected="false">Kas Keluar</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="setting-tab" data-bs-toggle="tab" href="#setting" role="tab" aria-controls="setting" aria-selected="false">Setting</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="desposit" role="tabpanel" aria-labelledby="desposit-tab">
                            <form action="<?= base_url('home'); ?>" method="post">
                                <div class="mb-3">
                                    <label for="idagen" class="form-label">ID Agen/Kode</label>
                                    <!-- <input type="text" name="idagen" id="idagen" class="form-control form-control-sm"> -->
                                    <select name="idagen" id="idagen" class="form-select">
                                        <option value="">Select ID</option>
                                        <?php foreach ($kontak as $k) { ?>
                                            <option value="<?= $k['id']; ?>"><?= $k['name']; ?></option>
                                        <?php }; ?>
                                    </select>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label for="produk" class="form-label">Produk</label>
                                        <input type="text" name="produk" id="produk" class="form-control form-control-sm">
                                    </div>
                                    <div class="col">
                                        <label for="tujuan" class="form-label">Tujuan</label>
                                        <input type="number" name="tujuan" id="tujuan" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control form-control-sm">
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" name="keterangan" id="keterangan" class="form-control form-control-sm">
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <?= validation_errors('<small class="text-danger pl-2">*', '</small>'); ?>
                        <div class="tab-pane fade" id="kaskeluar" role="tabpanel" aria-labelledby="kaskeluar-tab">
                            <form action="<?= base_url('home'); ?>" method="post">
                                <div class="mb-3">
                                    <!-- <label for="keterangan" class="form-label">Keterangan</label> -->
                                    <input type="text" name="kaskeluar" id="kaskeluar" class="form-control form-control-sm" value=1 hidden readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" name="keterangan" id="keterangan" class="form-control form-control-sm">
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control form-control-sm">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="setting" role="tabpanel" aria-labelledby="setting-tab">
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
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    Saldo & Transaksi
                </div>
                <div class="card-body">
                    <h5 class="card-title">Rekap Input Deposit & Transaksi</h5>

                    <table class="table table-sm table-hover display" id="mytable" style="font-size: 0.6em;">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Waktu</th>
                                <th>ID Agen</th>
                                <th>Produk</th>
                                <th>Tujuan</th>
                                <th>Kasir</th>
                                <th>Jumlah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dep_recap as $d) {; ?>
                                <tr>
                                    <td class="align-middle text-center"><?= $d['id']; ?></td>
                                    <td><?= $d['waktu']; ?></td>
                                    <td><?= $d['idagen']; ?><br><small style="font-style: italic;font-size:0.6rem">-<?= $d['keterangan']; ?>-</small></td>
                                    <td><?= $d['produk']; ?></td>
                                    <td><?= $d['tujuan']; ?></td>
                                    <td><?= $d['kasir']; ?></td>
                                    <td class="text-end"><?= number_format($d['jumlah']); ?></td>
                                    <td class="text-center align-middle">
                                        <a href="#" data-id="<?= $d['id']; ?>" class="cetak_struk"><i class="fas fa-print"></i></a> <a href="#" class="hapus_record" data-id="<?= $d['id']; ?>"><i class="fas fa-minus-square"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="row mb-2 mt-2">
                        <div class="col">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        Saldo Awal
                                    </h6>
                                    <p class="card-text text-end" style="font-size: 0.6rem;"><?= number_format($this->home_model->saldoAwal()); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        Kas Masuk
                                    </h6>
                                    <p class="card-text text-end" style="font-size: 0.6rem;"><?= number_format($this->home_model->kasMasuk()); ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <div class="card bg-dark text-white">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        Saldo Akhir
                                    </h6>
                                    <p class="card-text text-end" style="font-size: 0.6rem;"><?= number_format($this->home_model->saldoAkhir()); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        Kas Keluar
                                    </h6>
                                    <p class="card-text text-end" style="font-size: 0.6rem;"><?= number_format($this->home_model->kasKeluar()); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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