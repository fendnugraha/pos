<?php error_reporting(0); ?>
<div class="container mt-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">IRS GSM-EPAY</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">OTOMAX OKELINK</button>
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
            <div class="card">
                <div class="card-body">
                    <h1>IRS GSM-EPAY</h1>
                    <table class="table table-hover display">
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
                                    <td><?= $irs['idagen']; ?><br><?= $irs['produk']; ?> / <?= $irs['tujuan']; ?></td>
                                    <td><?= $irs['status']; ?></td>
                                    <td><?= number_format($irs['jumlah']); ?></td>
                                    <td><?= $irs['kasir']; ?></td>
                                    <td>Print / Hapus</td>
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
            <div class="card mt-3">
                <div class="card-body">
                    <h1>OKELINK OTOMAX</h1>
                    <table class="table table-hover display">
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
                                    <td><?= $oto['idagen']; ?><br><?= $oto['produk']; ?> / <?= $oto['tujuan']; ?></td>
                                    <td><?= $oto['status']; ?></td>
                                    <td><?= number_format($oto['jumlah']); ?></td>
                                    <td><?= $oto['kasir']; ?></td>
                                    <td>Print / Hapus</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</div>