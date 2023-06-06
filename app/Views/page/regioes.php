<?= $this->extend('layout/template') ?>

<?= $this->section('template') ?>
<section class="content">
  <div class="container-fluid">

    <div class="card">
      <div class="card-header">
        <form action="<?= base_url("admin/regioes") ?>" method="get" class="form form-inline">
          <div class="d-flex flex-md-row flex-column justify-content-between w-100">
            <div class="d-flex flex-md-row flex-column w-100 mb-md-0 mb-1" style="gap: 5px;">
              <input type="search" name="search" placeholder="Pesquisar" class="form-control" value="<?= $search ?>">
              <button type="submit" class="btn btn-dark">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </div>
            <button type="button" class="btn btn-dark" title="Adicionar" data-toggle="modal" data-target="#add-regiao">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
          </div>
        </form>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-condensed">
          <thead>
            <tr>
              <th>#</th>
              <th>CEP</th>
              <th>Frete</th>
              <th>Status</th>
              <th width="150">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($regioes as $item) : ?>
              <tr>
                <td><?= $item["id"] ?></td>
                <td class="cep"><?= $item["cep"] ?></td>
                <td><?= format_money($item["frete"]) ?></td>
                <td>
                  <a href="<?= base_url("admin/regioes/" . $item["id"] . "/status") ?>">
                    <span class="badge badge-<?= $item["status"] == ATIVO ? "success" : "danger" ?>">
                      <?= $item["status"] == ATIVO ? "ATIVO" : "INATIVO" ?>
                    </span>
                  </a>
                </td>
                <td style="width: 10px;">
                  <button type="button" class="btn btn-info" title="Editar" data-toggle="modal" data-target="#edit-regiao-<?= $item["id"] ?>">
                    <i class="fas fa-edit"></i>
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</section>


<!-- Modal ADD -->
<div class="modal fade" id="add-regiao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar região</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= base_url("admin/regioes/cadastrar") ?>" method="post">
        <div class="modal-body">

          <div class="form-group">
            <label for="cep">CEP<span class="text-danger">*</span></label>
            <input class="form-control cep" name="cep" id="cep" placeholder="CEP da região" required />
          </div>

          <div class="form-group">
            <label for="frete">Frete<span class="text-danger">*</span></label>
            <input class="form-control money" id="frete" name="frete" placeholder="Valor do frete" required />
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal EDIT -->
<?php foreach ($regioes as $item) : ?>
  <div class="modal fade" id="edit-regiao-<?= $item["id"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar região</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url("admin/regioes/" . $item["id"] . "/editar") ?>" method="post">
          <div class="modal-body">

            <div class="form-group">
              <label for="cep">CEP<span class="text-danger">*</span></label>
              <input class="form-control cep" name="cep" id="cep" value="<?= $item["cep"] ?>" placeholder="CEP da região" required />
            </div>

            <div class="form-group">
              <label for="frete">Frete<span class="text-danger">*</span></label>
              <input class="form-control money" id="frete" name="frete" value="<?= $item["frete"] ?>" placeholder="Valor do frete" required />
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>


<?= $this->endSection() ?>