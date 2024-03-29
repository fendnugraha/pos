<?php error_reporting(0); ?>
<div class="main-page">
    <div class="card" style="height: 100%;">
        <div class="card-body">
            <h4>Kas Masuk</h4>
            <form action="<?= base_url('transact/kasmasuk'); ?>" method="post">
                <div class="mb-3">
                    <!-- <label for="keterangan" class="form-label">Keterangan</label> -->
                    <input type="text" name="kasmasuk" id="kasmasuk" class="form-control form-control-sm" value=1 hidden readonly>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control form-control-sm" autocomplete="off">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="metodem" id="metodem1" value=0 checked>
                    <label class="form-check-label" for="metodem1">
                        Saldo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="metodem" id="metodem2" value=1>
                    <label class="form-check-label" for="metodem2">
                        Kas/Tunai
                    </label>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control form-control-sm" autocomplete="off">
                </div>
                <div class="form-check form-check-inline mb-3">
                    <input class="form-check-input" type="radio" name="jalur" id="irs" value="IRS" checked>
                    <label class="form-check-label" for="irs">IRS</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jalur" id="okelink" value="OKELINK">
                    <label class="form-check-label" for="okelink">OKELINK</label>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-sm btn-success">Input Kas Masuk</button>
                </div>
            </form>
        </div>
    </div>
</div>