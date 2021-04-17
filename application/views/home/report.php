<div class="container">
    <h4 class="display-4 mb-5">Laporan Non Deposit <?= $tanggal; ?></h4>
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
                    <a href="<?= base_url('home'); ?>" class="btn btn-sm btn-danger ml-3">Clear</a>
                </div>
            </div>
        </div>


    </form>
    <div class="row">
        <div class="col">
            <h4 class="text-success">Kas Masuk</h4>
            <table class="table display table-primary table-stripped">
                <thead>
                    <tr>
                        <th>ID</th>
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
                            <td><?= $n['keterangan']; ?></td>
                            <td class="text-end"><?= number_format($n['jumlah']); ?></td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
            <h5 class="text-end">Total: <?= number_format($totalIn); ?></h5>
        </div>
        <div class="col">
            <h4 class="text-danger">Kas Keluar</h4>
            <table class="table display table-dark table-stripped">
                <thead>
                    <tr>
                        <th>ID</th>
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
                            <td><?= $n['keterangan']; ?></td>
                            <td class="text-end"><?= number_format($n['jumlah']); ?></td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
            <h5 class="text-end">Total: <?= number_format($totalOut); ?></h5>
        </div>
    </div>

</div>