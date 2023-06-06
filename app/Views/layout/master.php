<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>We Delivery | <?= format_text($page_title) ?></title>

  <!-- FAVICON -->
  <link rel="icon" type="image/x-icon" href="<?= base_url("favicon_2.png") ?>">

  <!-- STYLES -->
  <link rel="stylesheet" href="<?= base_url("assets/css/global.css") ?>">
  <link rel="stylesheet" href="<?= base_url("assets/css/$page.css") ?>">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url("assets/plugins/fontawesome-free/css/all.min.css") ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url("assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css") ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url("assets/css/adminlte/adminlte.min.css") ?>">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url("assets/plugins/sweetalert2/sweetalert2.min.css") ?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url("assets/plugins/toastr/toastr.min.css") ?>">

  <!-- Toast -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" integrity="sha512-DIW4FkYTOxjCqRt7oS9BFO+nVOwDL4bzukDyDtMO7crjUZhwpyrWBFroq+IqRe6VnJkTpRAS6nhDvf0w+wHmxg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- CHART -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- JQUERY -->
  <script src="<?= base_url("assets/plugins/jquery/jquery.min.js") ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
  <!-- PAGES AUTH -->
  <?= $this->renderSection("auth") ?>

  <?php if ($page != "login") : ?>
    <div class="wrapper">

      <!-- NAVBAR -->
      <?= $this->renderSection("navbar") ?>

      <!-- SIDEBAR -->
      <?= $this->renderSection("sidebar") ?>

      <div class="content-wrapper <?= $page == "painel" ? "kanban" : "" ?>">
        <!-- BREADCRUMB -->
        <?= $this->renderSection('breadcrumb'); ?>

        <!-- TEMPLATE -->
        <?= $this->renderSection("template") ?>
      </div>

      <!-- FOOTER -->
      <?= $this->renderSection("footer") ?>

    </div>
  <?php endif; ?>

  <!-- SCRIPTS -->
  <script src="<?= base_url("assets/js/global.js") ?>"></script>
  <script src="<?= base_url("assets/js/$page.js") ?>"></script>

  <!-- jQuery -->
  <script src="<?= base_url("assets/plugins/jquery/jquery.min.js") ?>"></script>

  <!-- Bootstrap 4 -->
  <script src="<?= base_url("assets/plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>

  <!-- AdminLTE App -->
  <script src="<?= base_url("assets/js/adminlte/js/adminlte.min.js") ?>"></script>

  <!-- Toast -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- MASK -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- ChartJS -->
  <script src="<?= base_url("assets/plugins/chart.js/Chart.min.js") ?>"></script>

  <!-- ALERT AND TOAST -->
  <script>
    // SUCCESS
    $(function() {
      <?php if (session()->has("alert-success")) : ?>
        Swal.fire({
          icon: 'success',
          title: '<?= session("title") ?>',
          text: '<?= session("message") ?>'
        })
      <?php endif; ?>
      <?php if (session()->has("toast-success")) : ?>
        toast("<?= session("title") ?>", "<?= session("message") ?>", "success");
      <?php endif; ?>
    });

    // ERROR
    $(function() {
      <?php if (session()->has("alert-error")) : ?>
        Swal.fire({
          icon: 'error',
          title: '<?= session("title") ?>',
          text: '<?= session("message") ?>'
        })
      <?php endif; ?>
      <?php if (session()->has("toast-error")) : ?>
        toast("<?= session("title") ?>", "<?= session("message") ?>", "error");
      <?php endif; ?>
    });

    // WARNING
    $(function() {
      <?php if (session()->has("alert-warning")) : ?>
        Swal.fire({
          icon: 'warning',
          title: '<?= session("title") ?>',
          text: '<?= session("message") ?>'
        });
      <?php endif; ?>

      <?php if (session()->has("toast-warning")) : ?>
        toast("<?= session("title") ?>", "<?= session("message") ?>", "warning");
      <?php endif; ?>
    });

    // INFO
    $(function() {
      <?php if (session()->has("alert-info")) : ?>
        Swal.fire({
          icon: 'info',
          title: '<?= session("title") ?>',
          text: '<?= session("message") ?>'
        })
      <?php endif; ?>
      <?php if (session()->has("toast-info")) : ?>
        toast("<?= session("title") ?>", "<?= session("message") ?>", "info");
      <?php endif; ?>
    });
  </script>

</body>

</html>