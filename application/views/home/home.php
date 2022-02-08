<?php error_reporting(0); ?>
<div class="container mt-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">IRS GSM-EPAY</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">OTOMAX OKELINK</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="kastunai-tab" data-bs-toggle="tab" data-bs-target="#kastunai" type="button" role="tab" aria-controls="kastunai" aria-selected="false">KAS TUNAI</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="d-flex justify-content-around mt-3">
                <p class="text-center">SALDO AWAL<br>Rp. <?= number_format($this->home_model->saldoAwal(date("Y-m-d"), "IRS")); ?></p>
                <p class="text-center">PENAMBAHAN<br>Rp. <?= number_format($this->home_model->saldoMasuk(date("Y-m-d"), "IRS")); ?></p>
                <p class="text-center">TRANSFER SALDO<br>Rp. <?= number_format($this->home_model->saldoKeluar(date("Y-m-d"), "IRS")); ?></p>
                <p class="text-center">SALDO AKHIR<br>Rp. <?= number_format($this->home_model->saldoAkhir(date("Y-m-d"), "IRS")); ?></p>
            </div>
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <h1 class="text-primary">IRS GSM-EPAY</h1>
                    <table class="table table-hover display table-dark">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TANGGAL</th>
                                <th>DESKRIPSI</th>
                                <th>I / O</th>
                                <th>JUMLAH</th>
                                <th>KASIR</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($dep_recapirs as $irs) {
                            ?>
                                <tr>
                                    <td><?= $irs['id']; ?></td>
                                    <td><?= $irs['waktu']; ?></td>
                                    <td><span class="text-warning"><?= $irs['idagen']; ?></span><br><?= $irs['produk']; ?> / <?= $irs['tujuan']; ?> / <?= $irs['keterangan']; ?></td>
                                    <td><?= $irs['status']; ?></td>
                                    <td><?= number_format($irs['jumlah']); ?></td>
                                    <td><?= $irs['kasir']; ?></td>
                                    <td><button data-id="<?= $irs['id']; ?>" class="cetak_struk btn btn-sm btn-success"><i class="fas fa-print"></i></button> /
                                        <button data-id="<?= $irs['id']; ?>" class="hapus_record btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="d-flex justify-content-around mt-3">
                <p class="text-center">SALDO AWAL<br>Rp. <?= number_format($this->home_model->saldoAwal(date("Y-m-d"), "OKELINK")); ?></p>
                <p class="text-center">PENAMBAHAN<br>Rp. <?= number_format($this->home_model->saldoMasuk(date("Y-m-d"), "OKELINK")); ?></p>
                <p class="text-center">TRANSFER SALDO<br>Rp. <?= number_format($this->home_model->saldoKeluar(date("Y-m-d"), "OKELINK")); ?></p>
                <p class="text-center">SALDO AKHIR<br>Rp. <?= number_format($this->home_model->saldoAkhir(date("Y-m-d"), "OKELINK")); ?></p>
            </div>
            <div class="card">
                <div class="card-body">
                    <h1 class="text-danger">OKELINK OTOMAX</h1>
                    <table class="table table-hover display text-danger">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TANGGAL</th>
                                <th>DESKRIPSI</th>
                                <th>I / O</th>
                                <th>JUMLAH</th>
                                <th>KASIR</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($dep_recapoto as $oto) {
                            ?>
                                <tr>
                                    <td><?= $oto['id']; ?></td>
                                    <td><?= $oto['waktu']; ?></td>
                                    <td><span class="text-warning"><?= $oto['idagen']; ?></span><br><?= $oto['produk']; ?> / <?= $oto['tujuan']; ?> / <?= $oto['keterangan']; ?></td>
                                    <td><?= $oto['status']; ?></td>
                                    <td><?= number_format($oto['jumlah']); ?></td>
                                    <td><?= $oto['kasir']; ?></td>
                                    <td><button data-id="<?= $oto['id']; ?>" class="cetak_struk btn btn-sm btn-success"><i class="fas fa-print"></i></button> /
                                        <button data-id="<?= $oto['id']; ?>" class="hapus_record btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="kastunai" role="tabpanel" aria-labelledby="kastunai-tab">
            <div class="d-flex justify-content-around mt-3">
                <p class="text-center">SALDO AWAL<br>Rp. <?= number_format($this->home_model->kasAwal(date("Y-m-d"))); ?></p>
                <p class="text-center">PENAMBAHAN<br>Rp. <?= number_format($this->home_model->kasMasuk(date("Y-m-d"))); ?></p>
                <p class="text-center">TRANSFER KAS<br>Rp. <?= number_format($this->home_model->kasKeluar(date("Y-m-d"))); ?></p>
                <p class="text-center">KAS AKHIR<br>Rp. <?= number_format($this->home_model->kasAkhir(date("Y-m-d"))); ?></p>
            </div>
            <div class="card">
                <div class="card-body">
                    <h1 class="text-info">REKAP KAS TUNAI</h1>
                    <table class="table table-hover display text-primary">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TANGGAL</th>
                                <th>DESKRIPSI</th>
                                <th>I / O</th>
                                <th>JUMLAH</th>
                                <th>KASIR</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($dep_recapkas as $kas) {
                            ?>
                                <tr>
                                    <td><?= $kas['id']; ?></td>
                                    <td><?= $kas['waktu']; ?></td>
                                    <td><?= $kas['idagen']; ?><br><?= $kas['produk']; ?> / <?= $kas['tujuan']; ?> / <?= $kas['keterangan']; ?></td>
                                    <td><?= $kas['status']; ?></td>
                                    <td><?= number_format($kas['jumlah']); ?></td>
                                    <td><?= $kas['kasir']; ?></td>
                                    <td><?php
                                        if ($kas['jalur'] == "KAS" && $kas['status'] == "Out") {
                                        ?>
                                            <button data-id="<?= $kas['id']; ?>" class="cetak_kas_keluar btn btn-sm btn-success"><i class="fas fa-print"></i></button>
                                        <?php
                                        } else {
                                        ?>
                                            <button data-id="<?= $kas['id']; ?>" class="cetak_struk btn btn-sm btn-success"><i class="fas fa-print"></i></button>
                                        <?php
                                        }
                                        ?> /
                                        <button data-id="<?= $kas['id']; ?>" class="hapus_record btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



</div>