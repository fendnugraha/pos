<?php error_reporting(0); ?>
<div class="main-page">
    <div class="card overflow-y-auto" style="height: 100%">
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">IRS</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">OKELINK</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#kastunai" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">CASH</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    <div class="d-flex justify-content-around mt-3">
                        <p class="text-center">SALDO AWAL<br>Rp. <?= number_format($this->home_model->saldoAwal(date("Y-m-d"), "IRS")); ?></p>
                        <p class="text-center">PENAMBAHAN<br>Rp. <?= number_format($this->home_model->saldoMasuk(date("Y-m-d"), "IRS")); ?></p>
                        <p class="text-center">TRANSFER SALDO<br>Rp. <?= number_format($this->home_model->saldoKeluar(date("Y-m-d"), "IRS")); ?></p>
                        <p class="text-center">SALDO AKHIR<br>Rp. <?= number_format($this->home_model->saldoAkhir(date("Y-m-d"), "IRS")); ?></p>
                    </div>
                    <table class="table table-hover display-no-order table-dark nowrap">
                        <thead>
                            <tr>
                                <th>TANGGAL</th>
                                <th>DESKRIPSI</th>
                                <th>I / O</th>
                                <th>JUMLAH</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($dep_recapirs as $irs) {
                            ?>
                                <tr>
                                    <td><?= $irs['waktu']; ?></td>
                                    <td><span class="text-warning"><?= $irs['idagen']; ?></span><br><?= $irs['produk']; ?> / <?= $irs['tujuan']; ?> / <?= $irs['keterangan']; ?></td>
                                    <td><?= $irs['status']; ?></td>
                                    <td><?= number_format($irs['jumlah']); ?></td>
                                    <td><button data-id="<?= $irs['id']; ?>" class="cetak_struk btn btn-sm btn-success"><i class="fas fa-print"></i></button>
                                        <button data-id="<?= $irs['id']; ?>" class="hapus_record btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    <div class="d-flex justify-content-around mt-3">
                        <p class="text-center">SALDO AWAL<br>Rp. <?= number_format($this->home_model->saldoAwal(date("Y-m-d"), "OKELINK")); ?></p>
                        <p class="text-center">PENAMBAHAN<br>Rp. <?= number_format($this->home_model->saldoMasuk(date("Y-m-d"), "OKELINK")); ?></p>
                        <p class="text-center">TRANSFER SALDO<br>Rp. <?= number_format($this->home_model->saldoKeluar(date("Y-m-d"), "OKELINK")); ?></p>
                        <p class="text-center">SALDO AKHIR<br>Rp. <?= number_format($this->home_model->saldoAkhir(date("Y-m-d"), "OKELINK")); ?></p>
                    </div>
                    <table class="table table-hover display-no-order text-danger">
                        <thead>
                            <tr>
                                <th>TANGGAL</th>
                                <th>DESKRIPSI</th>
                                <th>I / O</th>
                                <th>JUMLAH</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($dep_recapoto as $oto) {
                            ?>
                                <tr>
                                    <td><?= $oto['waktu']; ?></td>
                                    <td><span class="text-warning"><?= $oto['idagen']; ?></span><br><?= $oto['produk']; ?> / <?= $oto['tujuan']; ?> / <?= $oto['keterangan']; ?></td>
                                    <td><?= $oto['status']; ?></td>
                                    <td><?= number_format($oto['jumlah']); ?></td>
                                    <td><button data-id="<?= $oto['id']; ?>" class="cetak_struk btn btn-sm btn-success"><i class="fas fa-print"></i></button>
                                        <button data-id="<?= $oto['id']; ?>" class="hapus_record btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="kastunai" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                    <div class="d-flex justify-content-around mt-3">
                        <p class="text-center">SALDO AWAL<br>Rp. <?= number_format($this->home_model->kasAwal(date("Y-m-d"))); ?></p>
                        <p class="text-center">PENAMBAHAN<br>Rp. <?= number_format($this->home_model->kasMasuk(date("Y-m-d"))); ?></p>
                        <p class="text-center">TRANSFER KAS<br>Rp. <?= number_format($this->home_model->kasKeluar(date("Y-m-d"))); ?></p>
                        <p class="text-center">KAS AKHIR<br>Rp. <?= number_format($this->home_model->kasAkhir(date("Y-m-d"))); ?></p>
                    </div>
                    <table class="table table-hover display-no-order text-primary">
                        <thead>
                            <tr>
                                <th>TANGGAL</th>
                                <th>DESKRIPSI</th>
                                <th>I / O</th>
                                <th>JUMLAH</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($dep_recapkas as $kas) {
                            ?>
                                <tr>
                                    <td><?= $kas['waktu']; ?></td>
                                    <td><?= $kas['idagen']; ?><br><?= $kas['produk']; ?> / <?= $kas['tujuan']; ?> / <?= $kas['keterangan']; ?></td>
                                    <td><?= $kas['status']; ?></td>
                                    <td><?= number_format($kas['jumlah']); ?></td>
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
                                        ?>
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