<?php error_reporting(0); ?>
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-sm">
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
            <div class="card">
                <!-- <div class="card-header">
                    Saldo & Transaksi
                </div> -->

                <div class="card-body">
                    <h5 class="card-title">Rekap Input Deposit & Transaksi</h5>
                    <table class="table table-striped table-bordered table-dark display table-responsive" id="mytable" style="font-size: 0.7em;">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Waktu</th>
                                <th>ID Agen</th>
                                <th>Kasir</th>
                                <th>Jumlah</th>
                                <th>Saldo Akhir</th>
                                <th>I/O</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sisasaldo = $this->home_model->saldoAwal($tanggal);
                            foreach ($dep_recap as $d) {;
                                if ($d['status'] == "In" && $d['metode'] == 0) {
                                    $sisasaldo += $d['jumlah'];
                                } elseif ($d['status'] == "Out" && $d['metode'] == 0 || $d['status'] == "Out" && $d['metode'] == 3) {
                                    $sisasaldo -= $d['jumlah'];
                                }
                            ?>
                                <tr>
                                    <td class="align-middle text-center"><?= $d['id']; ?></td>
                                    <td class="align-middle"><?= $d['waktu']; ?></td>
                                    <td class="align-middle"><?= $d['idagen']; ?>
                                        <?= $d['produk'] . " " . $d['tujuan']; ?><br>
                                        <small style="font-style: italic;font-size:0.6rem">-<?= $d['keterangan']; ?>-</small>
                                    </td>
                                    <td class="align-middle text-center"><?= $d['kasir']; ?></td>
                                    <td class="align-middle text-end"><?= number_format($d['jumlah']); ?></td>
                                    <td class="align-middle text-end"><?= number_format($sisasaldo); ?></td>
                                    <td class="align-middle text-center"><?php if ($d['status'] == "In") {
                                                                                echo '<span class="text-success"><i class="fas fa-backward"></i></span>';
                                                                            } else {
                                                                                echo '<span class="text-danger"><i class="fas fa-forward"></i></span>';
                                                                            }; ?></td>
                                    <td class="text-center align-middle">
                                        <a href="#" data-id="<?= $d['id']; ?>" class="cetak_struk btn btn-sm btn-success"><i class="fas fa-print"></i> Print</a> <a href="#" class="hapus_record btn btn-sm btn-danger" data-id="<?= $d['id']; ?>"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <hr>
                    <div class="row mb-2 mt-2">

                        <div class="col">
                            <h4>Saldo</h4>
                            <table class="table table-sm table-dark">
                                <tbody>
                                    <tr>
                                        <td>Saldo Awal</td>
                                        <td class="text-end text-primary fw-bold"><?= number_format($this->home_model->saldoAwal($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Masuk</td>
                                        <td class="text-end text-success fw-bold"><?= number_format($this->home_model->saldoMasuk($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Keluar</td>
                                        <td class="text-end text-danger fw-bold"><?= number_format($this->home_model->saldoKeluar($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Saldo Akhir</td>
                                        <td class="text-end fw-bold"><?= number_format($this->home_model->saldoAkhir($tanggal)); ?></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="col">
                            <h4>Kas</h4>
                            <table class="table table-sm table-success">
                                <tbody>
                                    <tr>
                                        <td>Kas Awal</td>
                                        <td class="text-end text-primary fw-bold"><?= number_format($this->home_model->kasAwal($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pendapatan</td>
                                        <td class="text-end text-success fw-bold"><?= number_format($this->home_model->kasMasuk($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Biaya</td>
                                        <td class="text-end text-danger fw-bold"><?= number_format($this->home_model->kasKeluar($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kas Akhir</td>
                                        <td class="text-end fw-bold"><?= number_format($this->home_model->kasAkhir($tanggal)); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
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
            <div class="card">
                <!-- <div class="card-header">
                    Saldo & Transaksi
                </div> -->

                <div class="card-body">
                    <h5 class="card-title">Rekap Input Deposit & Transaksi</h5>
                    <table class="table table-striped table-bordered table-dark display table-responsive" id="mytable" style="font-size: 0.7em;">
                        <thead>
                            <tr class="text-center">
                                <th>Waktu</th>
                                <th>ID Agen</th>
                                <th>Kasir</th>
                                <th>Jumlah</th>
                                <th>Saldo Akhir</th>
                                <th>I/O</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sisasaldo = $this->home_model->saldoAwal($tanggal);
                            foreach ($dep_recap as $d) {;
                                if ($d['status'] == "In" && $d['metode'] == 0) {
                                    $sisasaldo += $d['jumlah'];
                                } elseif ($d['status'] == "Out" && $d['metode'] == 0 || $d['status'] == "Out" && $d['metode'] == 3) {
                                    $sisasaldo -= $d['jumlah'];
                                }
                            ?>
                                <tr>
                                    <td class="align-middle">ID Transaksi: <?= $d['id']; ?><br><?= $d['waktu']; ?></td>
                                    <td class="align-middle"><?= $d['idagen']; ?>
                                        <?= $d['produk'] . " " . $d['tujuan']; ?><br>
                                        <small style="font-style: italic;font-size:0.6rem">-<?= $d['keterangan']; ?>-</small>
                                    </td>
                                    <td class="align-middle text-center"><?= $d['kasir']; ?></td>
                                    <td class="align-middle text-end"><?= number_format($d['jumlah']); ?></td>
                                    <td class="align-middle text-end"><?= number_format($sisasaldo); ?></td>
                                    <td class="align-middle text-center"><?php if ($d['status'] == "In") {
                                                                                echo '<span class="text-success"><i class="fas fa-backward"></i></span>';
                                                                            } else {
                                                                                echo '<span class="text-danger"><i class="fas fa-forward"></i></span>';
                                                                            }; ?></td>
                                    <td class="text-center align-middle">
                                        <a href="#" data-id="<?= $d['id']; ?>" class="cetak_struk btn btn-sm btn-success"><i class="fas fa-print"></i> Print</a> <a href="#" class="hapus_record btn btn-sm btn-danger" data-id="<?= $d['id']; ?>"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <hr>
                    <div class="row mb-2 mt-2">

                        <div class="col">
                            <h4>Saldo</h4>
                            <table class="table table-sm table-dark">
                                <tbody>
                                    <tr>
                                        <td>Saldo Awal</td>
                                        <td class="text-end text-primary fw-bold"><?= number_format($this->home_model->saldoAwal($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Masuk</td>
                                        <td class="text-end text-success fw-bold"><?= number_format($this->home_model->saldoMasuk($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Keluar</td>
                                        <td class="text-end text-danger fw-bold"><?= number_format($this->home_model->saldoKeluar($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Saldo Akhir</td>
                                        <td class="text-end fw-bold"><?= number_format($this->home_model->saldoAkhir($tanggal)); ?></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="col">
                            <h4>Kas</h4>
                            <table class="table table-sm table-success">
                                <tbody>
                                    <tr>
                                        <td>Kas Awal</td>
                                        <td class="text-end text-primary fw-bold"><?= number_format($this->home_model->kasAwal($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pendapatan</td>
                                        <td class="text-end text-success fw-bold"><?= number_format($this->home_model->kasMasuk($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Biaya</td>
                                        <td class="text-end text-danger fw-bold"><?= number_format($this->home_model->kasKeluar($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kas Akhir</td>
                                        <td class="text-end fw-bold"><?= number_format($this->home_model->kasAkhir($tanggal)); ?></td>
                                    </tr>
                                </tbody>
                            </table>
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