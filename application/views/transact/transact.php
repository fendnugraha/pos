<div class="main-page d-flex flex-column justify-content-between">
    <div class="card overflow-x-auto" style="height: 60%;">
        <div class="card-body">
            <h5 class="card-title border-bottom p-2">Form Input Deposit</h5>
            <form action="<?= base_url('transact'); ?>" method="post">
                <div class="row g-3 align-items-center mb-2">
                    <div class="col-6">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">ID</span>
                            <input type="text" name="idagen" class="form-control" placeholder="ID Agen" aria-label="idagen" aria-describedby="basic-addon1" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-auto">
                        <span id="passwordHelpInline" class="form-text">
                            Input angkanya saja.
                        </span>
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-7">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="text" name="jumlah" class="form-control" placeholder="Rupiah" aria-label="jumlah" aria-describedby="basic-addon1" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-auto">
                        <span id="passwordHelpInline" class="form-text">
                            Jumlah Deposit (Rp).
                        </span>
                    </div>
                </div>
                <div class="form-check form-switch mb-3">
                    <input name="cash" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Cash / Tunai</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jalur" id="irs" value="IRS" checked>
                    <label class="form-check-label" for="irs">GSM e-Pay (IRS)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jalur" id="okelink" value="OKELINK">
                    <label class="form-check-label" for="okelink">OKeLiNK</label>
                </div>
                <div class="row mt-4 gap-2">
                    <div class="col-sm">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary d-block">Submit</button>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="d-grid">
                            <button data-id="<?= $lastID = isset($lastRec['id']) ? $lastRec['id'] : 0; ?>" class="cetak_struk_form btn btn-success" <?php if (!isset($lastRec['id'])) {
                                                                                                                                                        echo "disabled";
                                                                                                                                                    }; ?>>Print</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <?php $hidden = isset($lastRec['id']) ? "" : "hidden"; ?>

    <div class="card d-flex align-items-center flex-row overflow-x-auto" style="height: 24%;">
        <div class="card-body">
            <?php
            if (isset($lastRec['id'])) {
                if ($lastRec['produk'] == "Isi Saldo Deposit") {
                    if ($lastRec['jalur'] == "IRS") {
                        $awalan = "TL.";
                    } else {
                        $awalan = "ADD.";
                    }
            ?>
                    <small class="text-muted">Latest Record at <?= $lastRec['waktu']; ?></small>
                    <h3><?= $lastRec['idagen']; ?> Rp. <?= number_format($lastRec['jumlah']); ?></h3>
                    <small>By <?= $lastRec['kasir']; ?></small>
                <?php }; ?>
            <?php }; ?>
        </div>
    </div>
    <div class="d-grid" style="height: 14%;">
        <?php
        if (isset($lastRec['id'])) { ?>
            <h1 class="text-center text-warning fw-bold" id="text" hidden><?= $awalan . "<span class='text-light'>" . preg_replace("/-/", "", substr($lastRec['idagen'], 0, 7)) . "</span>." . $lastRec['jumlah'] . ".1";
                                                                            ?></h1>
            <button class="btn btn-sm btn-warning btn-clipboard" id="btn-copy" onclick="copyToClipboard('#text')">
                <?= $awalan . "<span class='text-danger'>" . preg_replace("/-/", "", substr($lastRec['idagen'], 0, 7)) . "</span>." . $lastRec['jumlah'] . ".1";
                ?>
            </button>
        <?php }; ?>
    </div>
</div>