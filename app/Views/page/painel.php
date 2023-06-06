<?= $this->extend('layout/template') ?>

<?= $this->section('template') ?>

<section id="kanban" class="content">
  <div class="container-fluid h-100">

    <div class="card">
      <div class="card-header">
        <div class="form form-inline">
          <div class="d-flex flex-md-row flex-column justify-content-between">
            <div class="d-flex flex-md-row flex-column mb-md-0 mb-1" style="gap: 5px;">
              <input id="data" type="date" name="data" class="form-control" value="<?= isset($filtros["data"]) ? $filtros["data"] : "" ?>">
            </div>
          </div>
        </div>
      </div>

      <div class="card-body d-flex">
        <!-- PREPARANDO -->
        <div class="card card-row card-primary">
          <div class="card-header">
            <h3 class="card-title text-center w-100">PREPARANDO</h3>
          </div>
          <div class="card-body" id="card-fazer"></div>
        </div>

        <!-- FAZENDO -->
        <div class="card card-row card-warning">
          <div class="card-header">
            <h3 class="card-title text-center w-100">EM ROTA</h3>
          </div>
          <div class="card-body" id="card-fazendo"></div>
        </div>

        <!-- FEITO -->
        <div class="card card-row card-success">
          <div class="card-header">
            <h3 class="card-title text-center w-100">RECEBIDO</h3>
          </div>
          <div class="card-body" id="card-feito"></div>
        </div>
      </div>

    </div>
  </div>

</section>

<?= $this->endSection() ?>