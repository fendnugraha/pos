<div class="container mt-4 dashboard-home">
    <div class="menu-sources">
        <ul class="menu-sources-tab">
            <li class="menu-sources-item"><a href="<?= base_url('home'); ?>">
                    <h2>IRS</h2>
                </a></li>
            <li class="menu-sources-item"><a href="<?= base_url('home/okelink'); ?>">
                    <h2>OKELINK</h2>
                </a></li>
            <li class="menu-sources-item"><a href="<?= base_url('home/kastunai'); ?>" class="active">
                    <h2>KAS TUNAI</h2>
                </a></li>
        </ul>
    </div>
    <div class="info-saldo">
        <div class="card">
            <h5>SALDO AWAL</h5>Rp. <h1 class="text-end"><?= number_format($this->home_model->kasAwal(date("Y-m-d"))); ?></h1>
        </div>
        <div class="card">
            <h5>PENAMBAHAN</h5>Rp. <h1 class="text-end"><?= number_format($this->home_model->kasMasuk(date("Y-m-d"))); ?></h1>
        </div>
        <div class="card">
            <h5>TRANSFER SALDO</h5>Rp. <h1 class="text-end"><?= number_format($this->home_model->kasKeluar(date("Y-m-d"))); ?></h1>
        </div>
        <div class="card">
            <h5>SALDO AKHIR</h5>Rp. <h1 class="text-end"><?= number_format($this->home_model->kasAkhir(date("Y-m-d"))); ?></h1>
        </div>
    </div>
    <div class="table-rekap">
        <h4>REKAP IRS</h4>
        <table class="table table-hover display nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Waktu</th>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                    <th>Kasir</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dep_recapirs as $irs) {
                ?>
                    <tr class="<?php if ($irs['status'] == "In") {
                                    echo "text-success";
                                } else {
                                    echo "text-danger";
                                }; ?> ">
                        <td><?= $irs['id']; ?></td>
                        <td><?= $irs['waktu']; ?></td>
                        <td><span class="text-warning"><?= $irs['idagen']; ?></span><br><?= $irs['produk']; ?> / <?= $irs['tujuan']; ?> / <?= $irs['keterangan']; ?></td>
                        <td><?= number_format($irs['jumlah']); ?></td>
                        <td><?= $irs['kasir']; ?></td>
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
                            <button data-id="<?= $irs['id']; ?>" class="hapus_record btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>