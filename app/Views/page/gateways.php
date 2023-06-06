<?= $this->extend('layout/template') ?>

<?= $this->section('template') ?>
<section class="content">
  <div class="container-fluid">

    <div class="card">
      <div class="card-header">
        <form action="<?= base_url("admin/gateways") ?>" method="get" class="form form-inline">
          <div class="d-flex flex-md-row flex-column justify-content-between w-100">
            <div class="d-flex flex-md-row flex-column w-100 mb-md-0 mb-1" style="gap: 5px;">
              <input type="search" name="search" placeholder="Pesquisar" class="form-control" value="<?= $search ?>">
              <button type="submit" class="btn btn-dark">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </div>
            <button type="button" class="btn btn-dark" title="Adicionar" data-toggle="modal" data-target="#modalAdd">
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
              <th>Nome</th>
              <th>Status</th>
              <th width="150">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($gateways as $item) : ?>
              <tr>
                <td><?= $item["id"] ?></td>
                <td><?= $item["nome"] ?></td>
                <td>
                  <a href="<?= base_url("admin/gateways/" . $item["id"] . "/status") ?>">
                    <span class="badge badge-<?= $item["status"] == ATIVO ? "success" : "danger" ?>">
                      <?= $item["status"] == ATIVO ? "ATIVO" : "INATIVO" ?>
                    </span>
                  </a>
                </td>
                <td style="width: 10px;">
                  <button type="button" class="btn btn-info" title="Editar" data-toggle="modal" data-target="#modalEdit-<?= $item["id"] ?>">
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
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar gateway</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formAdd" action="<?= base_url("admin/gateways/cadastrar") ?>" method="POST">
        <div class="modal-body">

          <div class="form-group">
            <label for="nome">Nome <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do gateway" value="<?= old("nome") ?>">
            <div class="invalid-feedback"></div>
          </div>

          <div class="form-group">
            <label for="api_key">Chave da Api <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="api_key" id="api_key" placeholder="Chave da api" value="<?= old("api_key") ?>">
            <div class="invalid-feedback"></div>
          </div>

          <div class="form-group">
            <label for="secret_key">Chave Secreta <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="secret_key" id="secret_key" placeholder="Chave secreta" value="<?= old("secret_key") ?>">
            <div class="invalid-feedback"></div>
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
<?php foreach ($gateways as $item) : ?>
  <div class="modal fade" id="modalEdit-<?= $item["id"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar gateway</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formEdit" action="<?= base_url("admin/gateways/" . $item["id"] . "/editar") ?>" method="post">
          <div class="modal-body">

            <div class="form-group">
              <label for="nome">Nome <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="nome" id="nome" value="<?= $item["nome"] ?>" placeholder="Nome do gateway" required>
            </div>

            <div class="form-group">
              <label for="api_key">Chave da Api <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="api_key" id="api_key" placeholder="Chave da api" value="<?= $item["api_key"] ?>">
              <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
              <label for="secret_key">Chave Secreta <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="secret_key" id="secret_key" placeholder="Chave secreta" value="<?= $item["secret_key"] ?>">
              <div class="invalid-feedback"></div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" id="btnEdit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<?= $this->endSection() ?>