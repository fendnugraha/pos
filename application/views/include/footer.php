<script src="<?= base_url('assets/js/'); ?>bootstrap.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>jquery-1.12.4.js"></script>
<script src="<?= base_url('assets/js/'); ?>jquery-3.4.1.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>all.js"></script>
<script src="<?= base_url('assets/js/'); ?>fontawesome.js"></script>
<script src="<?= base_url('assets/js/'); ?>datatables.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>popper.min.js"></script>
<script>
    $(document).ready(function() {
        $('table.display').DataTable();
    });

    $('.cetak_struk').on('click', function(e) {
        const transferId = $(this).data('id');

        e.preventDefault()
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
</script>