<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-sm">
            <!-- <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body"> -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="desposit-tab" data-bs-toggle="tab" href="#desposit" role="tab" aria-controls="desposit" aria-selected="true">Transaksi</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="kasmasuk-tab" data-bs-toggle="tab" href="#kasmasuk" role="tab" aria-controls="kasmasuk" aria-selected="false">Kas Masuk</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="kaskeluar-tab" data-bs-toggle="tab" href="#kaskeluar" role="tab" aria-controls="kaskeluar" aria-selected="false">Kas Keluar</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="desposit" role="tabpanel" aria-labelledby="desposit-tab">
                    <form action="<?= base_url('home'); ?>" method="post">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Deposit
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="mb-3">
                                            <label for="idagen" class="form-label">ID Agen/Kode</label>
                                            <input type="text" name="idagen" id="idagen" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="cash" name="cash" value=3 checked>
                                            <label class="form-check-label" for="cash" id="label-cash">
                                                Cash/Tunai
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Pulsa & Data
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row mb-3">
                                            <div class="col-4">
                                                <label for="produk" class="form-label">Produk</label>
                                                <input type="text" name="produk" id="produk" class="form-control form-control-sm">
                                            </div>
                                            <div class="col">
                                                <label for="tujuan" class="form-label">Tujuan</label>
                                                <input type="number" name="tujuan" id="tujuan" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control form-control-sm" placeholder="Harus diisi">
                                </div>
                                <!-- <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" name="keterangan" id="keterangan" class="form-control form-control-sm" placeholder="Opsional">
                                </div> -->
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-primary mt-2">Submit</button>
                        </div>
                    </form>
                </div>
                <?= validation_errors('<small class="text-danger pl-2">*', '</small>'); ?>
                <?= $this->session->flashdata('message'); ?>
                <div class="tab-pane fade" id="kaskeluar" role="tabpanel" aria-labelledby="kaskeluar-tab">
                    <form action="<?= base_url('home'); ?>" method="post">
                        <div class="mb-3">
                            <!-- <label for="keterangan" class="form-label">Keterangan</label> -->
                            <input type="text" name="kaskeluar" id="kaskeluar" class="form-control form-control-sm" value=1 hidden readonly>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control form-control-sm">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metodek" id="metodek1" value=0>
                            <label class="form-check-label" for="metodek1">
                                Saldo
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metodek" id="metodek2" value=1 checked>
                            <label class="form-check-label" for="metodek2">
                                Kas/Tunai
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control form-control-sm">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-danger">Input Kas Keluar</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="kasmasuk" role="tabpanel" aria-labelledby="kasmasuk-tab">
                    <form action="<?= base_url('home'); ?>" method="post">
                        <div class="mb-3">
                            <!-- <label for="keterangan" class="form-label">Keterangan</label> -->
                            <input type="text" name="kasmasuk" id="kasmasuk" class="form-control form-control-sm" value=1 hidden readonly>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control form-control-sm">
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
                            <input type="number" name="jumlah" id="jumlah" class="form-control form-control-sm">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-success">Input Kas Masuk</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- </div>
            </div> -->
        </div>
        <div class="col-sm-9">
            <form action="<?= base_url('home'); ?>" method="post" class="mb-3">
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
            <div class="card">
                <!-- <div class="card-header">
                    Saldo & Transaksi
                </div> -->

                <div class="card-body">
                    <h5 class="card-title">Rekap Input Deposit & Transaksi</h5>
                    <table class="table table-sm table-hover display table-responsive" id="mytable" style="font-size: 0.7em;">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Waktu</th>
                                <th>ID Agen</th>
                                <th>Produk</th>
                                <th>Tujuan</th>
                                <th>Kasir</th>
                                <th>Jumlah</th>
                                <th>Saldo Akhir</th>
                                <th>I/O</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sisasaldo = $this->home_model->saldoAwal($tanggal);
                            foreach ($dep_recap as $d) {;
                                if ($d['status'] == "In" && $d['metode'] == 0) {
                                    $sisasaldo += $d['jumlah'];
                                } elseif ($d['status'] == "Out" && $d['metode'] == 0) {
                                    $sisasaldo -= $d['jumlah'];
                                }
                            ?>
                                <tr>
                                    <td class="align-middle text-center"><?= $d['id']; ?></td>
                                    <td><?= $d['waktu']; ?></td>
                                    <td><?= $d['idagen']; ?><br><small style="font-style: italic;font-size:0.6rem">-<?= $d['keterangan']; ?>-</small></td>
                                    <td><?= $d['produk']; ?></td>
                                    <td><?= $d['tujuan']; ?></td>
                                    <td><?= $d['kasir']; ?></td>
                                    <td class="text-end"><?= number_format($d['jumlah']); ?></td>
                                    <td class="text-end"><?= number_format($sisasaldo); ?></td>
                                    <td class="text-center"><?php if ($d['status'] == "In") {
                                                                echo '<span class="text-success"><i class="fas fa-backward"></i></span>';
                                                            } else {
                                                                echo '<span class="text-danger"><i class="fas fa-forward"></i></span>';
                                                            }; ?></td>
                                    <td class="text-center align-middle">
                                        <a href="#" data-id="<?= $d['id']; ?>" class="cetak_struk"><i class="fas fa-print"></i></a> <a href="#" class="hapus_record" data-id="<?= $d['id']; ?>"><i class="fas fa-minus-square"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <hr>
                    <div class="row mb-2 mt-2">

                        <div class="col">
                            <h4>Saldo</h4>
                            <table class="table table-sm table-dark">
                                <tbody>
                                    <tr>
                                        <td>Saldo Awal</td>
                                        <td class="text-end text-primary fw-bold"><?= number_format($this->home_model->saldoAwal($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Masuk</td>
                                        <td class="text-end text-success fw-bold"><?= number_format($this->home_model->saldoMasuk($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Keluar</td>
                                        <td class="text-end text-danger fw-bold"><?= number_format($this->home_model->saldoKeluar($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Saldo Akhir</td>
                                        <td class="text-end fw-bold"><?= number_format($this->home_model->saldoAkhir($tanggal)); ?></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="col">
                            <h4>Kas</h4>
                            <table class="table table-sm table-success">
                                <tbody>
                                    <tr>
                                        <td>Kas Awal</td>
                                        <td class="text-end text-primary fw-bold"><?= number_format($this->home_model->kasAwal($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pendapatan</td>
                                        <td class="text-end text-success fw-bold"><?= number_format($this->home_model->kasMasuk($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Biaya</td>
                                        <td class="text-end text-danger fw-bold"><?= number_format($this->home_model->kasKeluar($tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kas Akhir</td>
                                        <td class="text-end fw-bold"><?= number_format($this->home_model->kasAkhir($tanggal)); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row mt-4">
        <div class="col-sm">
            <div class="card">
                <div class="card-header">
                    Rekap Transaksi
                </div>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div> -->
</div>