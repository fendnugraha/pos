<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-sm">
            <!-- <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body"> -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="desposit-tab" data-bs-toggle="tab" href="#desposit" role="tab" aria-controls="desposit" aria-selected="true">Desposit</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="kasmasuk-tab" data-bs-toggle="tab" href="#kasmasuk" role="tab" aria-controls="kasmasuk" aria-selected="false">Kas Masuk</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="kaskeluar-tab" data-bs-toggle="tab" href="#kaskeluar" role="tab" aria-controls="kaskeluar" aria-selected="false">Kas Keluar</a>
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
                            <button type="submit" class="btn btn-sm btn-danger">Input Kas Keluar</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="kasmasuk" role="tabpanel" aria-labelledby="kasmasuk-tab">
                    <form action="<?= base_url('home'); ?>" method="post">
                        <div class="mb-3">
                            <!-- <label for="keterangan" class="form-label">Keterangan</label> -->
                            <input type="text" name="kasmasuk" id="kasmasuk" class="form-control form-control-sm" value=1 hidden readonly>
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
                            <button type="submit" class="btn btn-sm btn-success">Input Kas Masuk</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- </div>
            </div> -->
        </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header">
                    Saldo & Transaksi
                </div>
                <div class="card-body">
                    <h5 class="card-title">Rekap Input Deposit & Transaksi</h5>
                    <form action="<?= base_url('home'); ?>" method="post" class="mb-3">
                        <div class="row">
                            <div class="col">
                                <div class="mb3">
                                    <input type="date" name="tanggal" id="tanggal" class="form-control form-control-sm" value="<?= date('Y-m-d'); ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb3">
                                    <button type="submit" class="btn btn-sm btn-primary mr-3">View</button>
                                    <a href="<?= base_url('home'); ?>" class="btn btn-sm btn-danger ml-3">Clear</a>
                                </div>
                            </div>
                        </div>


                    </form>
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
                                <th>I/O</th>
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
                                    <td class="text-center"><?php if ($d['status'] == "In") {
                                                                echo '<span class="text-success"><i class="fas fa-backward"></i></span>';
                                                            } else {
                                                                echo '<span class="text-danger"><i class="fas fa-forward"></i></span>';
                                                            }; ?></td>
                                    <td class="text-center align-middle">
                                        <a href="#" data-id="<?= $d['id']; ?>" class="cetak_struk"><i class="fas fa-print"></i></a> <a href="#" class="hapus_record" data-id="<?= $d['id']; ?>"><i class="fas fa-minus-square"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <hr>
                    <div class="row mb-2 mt-2">

                        <div class="col">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <td>Saldo Awal</td>
                                        <td class="text-end text-primary fw-bold"><?= number_format($this->home_model->saldoAwal()); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Masuk</td>
                                        <td class="text-end text-success fw-bold"><?= number_format($this->home_model->kasMasuk()); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Keluar</td>
                                        <td class="text-end text-danger fw-bold"><?= number_format($this->home_model->kasKeluar()); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Saldo Akhir</td>
                                        <td class="text-end fw-bold"><?= number_format($this->home_model->saldoAkhir()); ?></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="col">
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