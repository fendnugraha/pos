<?php
$result = $result["general_ledger"];

?>
<div class="container">
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?= $result["report"]["accounts"][0]["subheader"]; ?></h4>
                    <h1 class="card-text text-end">Rp. <?= $result["report"]["accounts"][0]["ending_balance"]["balance"]; ?></h1>
                </div>
                <?= $result["header"]["period"]; ?>
                <table class="table display">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Memo</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $transaction = $result["report"]["accounts"][0]["content"];
                        foreach ($transaction as $tr) {
                        ?>
                            <tr>
                                <td><?= $tr["transaction"]["date"]; ?></td>
                                <td>
                                    <small><?= $tr["transaction"]["transaction_type"]; ?></small><br>
                                    <?= $tr["transaction"]["description"]; ?>
                                </td>
                                <td><?= $tr["transaction"]["debit"]; ?></td>
                                <td><?= $tr["transaction"]["credit"]; ?></td>
                                <td><?= $tr["transaction"]["balance"]; ?></td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Pendapatan Konter</p>
                    <h5 class="text-end"><?= number_format($result["report"]["accounts"][0]["ending_balance"]["balance_raw"]); ?></h5>
                    <p class="mb-0">Pendapatan IRS</p>
                    <h5 class="text-end"><?= number_format($setting['saldo_actual_irs']); ?></h5>
                    <p class="mb-0">Pendapatan OKELINK</p>
                    <h5 class="text-end"><?= number_format($setting['saldo_actual_ox']); ?></h5>
                    <hr>
                    <p>Total Pendapatan (Rp)</p>
                    <h4 class="text-end fw-bold"><sup>Rp. </sup><?= number_format($result["report"]["accounts"][0]["ending_balance"]["balance_raw"] + $setting['saldo_actual_irs'] + $setting['saldo_actual_ox']); ?></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="card pb-0">
                <div class="card-body">
                    <form action="<?= base_url('home'); ?>" method="post">
                        <div class="row">

                            <div class="mb-3 col">
                                <label for="saldoirs" class="form-label">Total Pendapatan IRS</label>
                                <input type="text" name="saldoirs" id="saldoirs" class="form-control form-control-sm" value="<?= $setting['saldo_actual_irs']; ?>">
                                <p class="text-end">Rp. <?= number_format($setting['saldo_actual_irs']); ?></p>
                            </div>
                            <div class="mb-3 col">
                                <label for="saldookelink" class="form-label">Total Pendapatan Okelink</label>
                                <input type="text" name="saldookelink" id="saldookelink" class="form-control form-control-sm" value="<?= $setting['saldo_actual_ox']; ?>">
                                <p class="text-end">Rp. <?= number_format($setting['saldo_actual_ox']); ?></p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col">

        </div>
    </div>


</div>