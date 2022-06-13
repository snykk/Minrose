<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="<?= base_url("assets/") ?>js/scripts.js"></script>
<script src="<?= base_url("assets/") ?>js/chart_penjualan.js"></script>
<script src="<?= base_url("assets/") ?>js/chart_keuntungan.js"></script>
<!-- <script src="<//?= base_url("assets/") ?>js/tabel_userrr.js"></script> -->

<?php if (isset($js)) : ?>
  <script src="<?= base_url("assets/") ?>js/<?= $js; ?>.js"></script>
<?php endif; ?>
<?php if (isset($cdn_datatable)) : ?>
  <script src="<?= $cdn_datatable; ?>"></script>
<?php endif; ?>
</body>

</html>