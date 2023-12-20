<div class="card user-login">
    <div class="card-body d-flex justify-content-center align-items-center">
        <!-- <h2><i class="fa-solid fa-masks-theater"></i> @fendnugraha</h2> -->
        <div class="dropdown">
            <a class="user-name text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-masks-theater"></i> @<?= ucwords($user['name']); ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="card latest-input">
    <div class="card-body overflow-y-auto">
        <?php foreach ($recentdep as $rdep) {
            if ($rdep['jalur'] == "IRS") {
                $awalan = "TL.";
            } else {
                $awalan = "ADD.";
            } ?>
            <div class="latest-post border-bottom pb-2">
                <small class="text-muted d-block" style="font-size: 0.6em;"><?= $rdep['waktu'] ?> | <?= ucwords($rdep['idagen']) ?></small>
                <p class=" mb-0" style="font-size: 0.8em;"><?= ucwords($rdep['produk'] . " " . $rdep['keterangan']) . " Rp. " . number_format($rdep['jumlah']) . " (" . $rdep['kasir'] . ")"; ?></p>
                <span class="badge bg-secondary" style="font-size: 0.6em;">
                    <?= $awalan . preg_replace("/-/", "", substr($rdep['idagen'], 0, 7)) . "." . $rdep['jumlah'] . ".1";
                    ?>
                </span>
            </div>
        <?php } ?>
    </div>
</div>
</div>
</div>


<script src="<?= base_url('assets'); ?>/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/jquery-3.7.0.js"></script>
<script src="<?= base_url('assets'); ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/jquery-ui.js"></script>
<script src="<?= base_url('assets'); ?>/js/fontawesome.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/all.min.js"></script>
<!-- <script src="<?= base_url('assets'); ?>/js/myjs.js"></script> -->
<script src="<?= base_url('assets/js/'); ?>myjs.js"></script>
<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }

    $(document).ready(function() {
        $("#idagen").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo base_url('transact/cariAgen'); ?>",
                    data: {
                        term: request.term
                    },
                    dataType: "json",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2
        });


    });

    $('.status_thr').on('click', function() {
        // console.log('ok');
        const idagen = $(this).data('idagen');

        $.ajax({
            url: '<?= base_url('home/changestatusthr'); ?>',
            type: 'post',
            data: {
                idagen: idagen,
            },

            success: function() {
                // alert('Access has been changed !');
                document.location.href = "<?= base_url('home/thr/'); ?>";

            }
        });
    });


    $("button#btn-copy").click(function() {
        $(this).html("<i class='fa-solid fa-clipboard'></i> Text Copied!");
        $(this).addClass("btn-success");
        $(this).removeClass("btn-warning");
        // console.log("berhasil");
    });

    $('.cetak_struk').on('click', function(e) {
        const transferId = $(this).data('id');

        e.preventDefault()
        if (confirm('Cetak transaksi ID ' + transferId + ' ?')) {
            $.ajax({
                type: 'post',
                url: "<?= base_url('home/faktur_print'); ?>",
                data: {
                    transferId: transferId,
                },
                success: function() {
                    document.location.href = "<?= base_url('home/home2'); ?>";
                }
            });
        }
    });

    $('.cetak_struk_form').on('click', function(e) {
        const transferId = $(this).data('id');

        e.preventDefault()
        if (confirm('Cetak transaksi ID ' + transferId + ' ?')) {
            $.ajax({
                type: 'post',
                url: "<?= base_url('home/faktur_print'); ?>",
                data: {
                    transferId: transferId,
                },
                success: function() {
                    document.location.href = "<?= base_url('transact'); ?>";
                }
            });
        }
    });

    $('.cetak_kas_keluar').on('click', function(e) {
        const transferId = $(this).data('id');

        e.preventDefault()
        if (confirm('Cetak transaksi ID ' + transferId + ' ?')) {
            $.ajax({
                type: 'post',
                url: "<?= base_url('home/kas_keluar_cetak'); ?>",
                data: {
                    transferId: transferId,
                },
                success: function() {
                    document.location.href = "<?= base_url('home'); ?>";
                }
            });
        }
    });

    $('.hapus_record').on('click', function(e) {
        const transferId = $(this).data('id');
        e.preventDefault()
        if (confirm('Hapus transaksi ID ' + transferId + ' ?')) {
            $.ajax({
                type: 'post',
                url: "<?= base_url('home/hapus_record'); ?>",
                data: {
                    transferId: transferId,
                },
                success: function() {
                    document.location.href = "<?= base_url('home/home2'); ?>";
                }
            });
        }
    });
    $('.cetak-laporan').on('click', function(e) {
        const tanggal = $(this).data('id');

        e.preventDefault()
        if (confirm('Cetak laporan ' + tanggal + ' ?')) {
            $.ajax({
                type: 'post',
                url: "<?= base_url('home/dailyReport'); ?>",
                data: {
                    tanggal: tanggal,
                },
                success: function() {
                    document.location.href = "<?= base_url('home/report'); ?>";
                }
            });
        }
    });
</script>