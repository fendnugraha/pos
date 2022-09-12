<div class="container mt-4 dashboard-home">
    <div class="menu-sources">
        <ul class="menu-sources-tab">
            <li class="menu-sources-item"><a href="#" class="active">
                    <h2>IRS</h2>
                </a></li>
            <li class="menu-sources-item"><a href="#">
                    <h2>OKELINK</h2>
                </a></li>
            <li class="menu-sources-item"><a href="#">
                    <h2>KAS TUNAI</h2>
                </a></li>
        </ul>
    </div>
    <div class="info-saldo">
        <div class="card bg-primary text-light">
            <h4>SALDO AWAL</h4>Rp. <h2 class="text-end"><?= number_format($this->home_model->saldoAwal(date("Y-m-d"), "IRS")); ?></h2>
        </div>
        <div class="card bg-success text-light">
            <h4>PENAMBAHAN</h4>Rp. <h2 class="text-end"><?= number_format($this->home_model->saldoMasuk(date("Y-m-d"), "IRS")); ?></h2>
        </div>
        <div class="card bg-warning text-dark">
            <h4>TRANSFER SALDO</h4>Rp. <h2 class="text-end"><?= number_format($this->home_model->saldoKeluar(date("Y-m-d"), "IRS")); ?></h2>
        </div>
        <div class="card bg-dark text-light">
            <h4>SALDO AKHIR</h4>Rp. <h2 class="text-end"><?= number_format($this->home_model->saldoAkhir(date("Y-m-d"), "IRS")); ?></h2>
        </div>
    </div>
    <div class="card table-rekap">
        <table class="table table-hover display table-dark nowrap">
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