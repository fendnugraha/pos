<script src="<?= base_url('assets/js/'); ?>bootstrap.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>jquery-1.12.4.js"></script>
<script src="<?= base_url('assets/js/'); ?>jquery-ui.js"></script>
<script src="<?= base_url('assets/js/'); ?>jquery-3.4.1.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>all.js"></script>
<script src="<?= base_url('assets/js/'); ?>fontawesome.js"></script>
<script src="<?= base_url('assets/js/'); ?>datatables.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>popper.min.js"></script>
<script>
    $(document).ready(function() {
        $('table.display').DataTable({
            "order": [
                [1, "desc"]
            ]
        });
    });

    $(document).ready(function() {
        $(".datepicker").datepicker();
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
                    document.location.href = "<?= base_url('home'); ?>";
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
                    document.location.href = "<?= base_url('home'); ?>";
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