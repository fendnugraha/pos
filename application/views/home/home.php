<div class="container">
    <div class="row mt-4">
        <div class="col-sm">
            <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="desposit-tab" data-bs-toggle="tab" href="#desposit" role="tab" aria-controls="desposit" aria-selected="true">Desposit</a>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                            <a class="nav-link" id="transaksi-tab" data-bs-toggle="tab" href="#transaksi" role="tab" aria-controls="transaksi" aria-selected="false">Transaksi</a>
                        </li> -->
                        <!-- <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                        </li> -->
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="desposit" role="tabpanel" aria-labelledby="desposit-tab">
                            <form action="<?= base_url('home'); ?>" method="post">
                                <div class="row g-3 mt-2 mb-2">
                                    <div class="col-sm">
                                        <label for="idagen">ID Agen/Kode</label>
                                        <input type="text" name="idagen" id="idagen" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-sm-7">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="number" name="jumlah" id="jumlah" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>

                            </form>
                            <?= validation_errors('<small class="text-danger pl-2">*', '</small>'); ?>
                        </div>
                        <!-- <div class="tab-pane fade" id="transaksi" role="tabpanel" aria-labelledby="transaksi-tab">
                            Input Transaksi Disini
                        </div> -->
                        <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    Saldo & Transaksi
                </div>
                <div class="card-body">
                    <h5 class="card-title">Rekap Input Deposit & Transaksi</h5>
                    <table class="table table-sm table-hover display" id="mytable">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>ID Agen</th>
                                <th>Jumlah</th>
                                <th>Kasir</th>
                                <th>Waktu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dep_recap as $d) {; ?>
                                <tr>
                                    <td><?= $d['id']; ?></td>
                                    <td><?= $d['idagen']; ?></td>
                                    <td><?= number_format($d['jumlah']); ?></td>
                                    <td><?= $d['kasir']; ?></td>
                                    <td><?= date('d F Y H:i:s', $d['waktu']); ?></td>
                                    <td class="text-center"><i class="fas fa-print"></i> <i class="fas fa-minus-square"></i></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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