<div class="container">
    <h4 class="display-4 mb-5">Laporan Non Deposit</h4>
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