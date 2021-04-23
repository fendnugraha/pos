<style>
    td {
        font-size: 0.8rem;
    }
</style>
<div class="container">
    <h4 class="display-5 mb-5">Laporan Non Deposit <?= $tanggal; ?></h4>
    <form action="<?= base_url('home/report'); ?>" method="post" class="mb-3">
        <div class="row">
            <div class="col">
                <div class="mb3">
                    <input type="date" name="tanggal" id="tanggal" class="form-control form-control-sm" value="<?= date('Y-m-d'); ?>" autocomplete="off">
                </div>
            </div>
            <div class="col">
                <div class="mb3">
                    <button type="submit" class="btn btn-sm btn-primary mr-3">View</button>
                    <a href="<?= base_url('home/report'); ?>" class="btn btn-sm btn-danger ml-3">Clear</a>
                    <a href="#" data-id="<?= $tanggal; ?>" class="btn btn-sm btn-danger ml-3 cetak-laporan"><i class="fas fa-print"></i> Cetak Laporan</a>
                </div>
            </div>
        </div>
    </form>
    <h4 class="text-success">Kas Masuk</h4>
    <table class="table table-sm display table-primary table-stripped table-responsive">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Waktu</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalIn = 0;
            foreach ($nonDepIn as $n) {
                $totalIn += $n['jumlah']; ?>
                <tr>
                    <td><?= $n['id']; ?></td>
                    <td><?= $n['waktu']; ?></td>
                    <td><?= $n['keterangan']; ?></td>
                    <td class="text-end"><?= number_format($n['jumlah']); ?></td>
                </tr>
            <?php }; ?>
        </tbody>
    </table>
    <h5 class="text-end">Total: <?= number_format($totalIn); ?></h5>
    <h4 class="text-danger">Kas Keluar</h4>
    <table class="table table-sm display table-dark table-stripped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Waktu</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalOut = 0;
            foreach ($nonDepOut as $n) {
                $totalOut += $n['jumlah'];
            ?>
                <tr>
                    <td><?= $n['id']; ?></td>
                    <td><?= $n['waktu']; ?></td>
                    <td><?= $n['keterangan']; ?></td>
                    <td class="text-end"><?= number_format($n['jumlah']); ?></td>
                </tr>
            <?php }; ?>
        </tbody>
    </table>
    <h5 class="text-end">Total: <?= number_format($totalOut); ?></h5>
    <h4 class="text-success">Bon Saldo</h4>
    <table class="table table-sm display table-warning table-stripped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Waktu</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalBon = 0;
            foreach ($nonDepBon as $n) {
                $totalBon += $n['jumlah']; ?>
                <tr>
                    <td><?= $n['id']; ?></td>
                    <td><?= $n['waktu']; ?></td>
                    <td><?= $n['idagen']; ?></td>
                    <td class="text-end"><?= number_format($n['jumlah']); ?></td>
                </tr>
            <?php }; ?>
        </tbody>
    </table>
    <h5 class="text-end">Total: <?= number_format($totalBon); ?></h5>
    <h4 class="text-primary">User</h4>
    <table class="table table-sm display table-stripped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Waktu Login</th>
                <th>Waktu Logout</th>
                <th>Sisa Saldo</th>
                <th>Sisa Kas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($userlogin as $n) { ?>
                <tr>
                    <td><?= $n['id']; ?></td>
                    <td><?= strtoupper($n['name']); ?></td>
                    <td><?= $n['uname']; ?></td>
                    <td><?= date('Y-m-d H:i:s', $n['last_login']); ?></td>
                    <td><?= date('Y-m-d H:i:s', $n['last_logout']); ?></td>
                    <td class="text-end"><?= number_format($n['sisasaldo']); ?></td>
                    <td class="text-end"><?= number_format($n['kasakhir']); ?></td>
                </tr>
            <?php }; ?>
        </tbody>
    </table>
</div>