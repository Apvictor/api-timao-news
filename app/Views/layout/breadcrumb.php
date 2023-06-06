<?= $this->section('breadcrumb') ?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?= $page_title ?></h1>
      </div>

      <?php if ($page !== "dashboard") : ?>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url("admin/dashboard") ?>">Dashboard</a></li>
            <li class="breadcrumb-item active"><?= $page_title ?></li>
          </ol>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>

<?= $this->endSection() ?>