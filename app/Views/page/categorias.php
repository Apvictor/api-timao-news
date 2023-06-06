<?= $this->extend('layout/template') ?>

<?= $this->section('template') ?>
<section class="content">
  <div class="container-fluid">

    <div class="card">
      <div class="card-header">
        <form action="<?= base_url("admin/categorias") ?>" method="get" class="form form-inline">
          <div class="d-flex flex-md-row flex-column justify-content-between w-100">
            <div class="d-flex flex-md-row flex-column w-100 mb-md-0 mb-1" style="gap: 5px;">
              <input type="search" name="search" placeholder="Pesquisar" class="form-control" value="<?= $search ?>">
              <button type="submit" class="btn btn-dark">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </div>
            <button type="button" class="btn btn-dark" title="Adicionar" data-toggle="modal" data-target="#modalAddCategoria">
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
            <?php foreach ($categorias as $item) : ?>
              <tr>
                <td><?= $item["id"] ?></td>
                <td><?= $item["nome"] ?></td>
                <td>
                  <a href="<?= base_url("admin/categorias/" . $item["id"] . "/status") ?>">
                    <span class="badge badge-<?= $item["status"] == ATIVO ? "success" : "danger" ?>">
                      <?= $item["status"] == ATIVO ? "ATIVO" : "INATIVO" ?>
                    </span>
                  </a>
                </td>
                <td style="width: 10px;">
                  <button type="button" class="btn btn-info" title="Editar" data-toggle="modal" data-target="#modalEditCategoria-<?= $item["id"] ?>">
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
<div class="modal fade" id="modalAddCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formAddCategoria" action="<?= base_url("admin/categorias/cadastrar") ?>" method="POST">
        <div class="modal-body">

          <div class="form-group">
            <label for="nome">Nome <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome da categoria" value="<?= old("nome") ?>">
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
<?php foreach ($categorias as $item) : ?>
  <div class="modal fade" id="modalEditCategoria-<?= $item["id"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar categoria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formEditCategoria" action="<?= base_url("admin/categorias/" . $item["id"] . "/editar") ?>" method="post">
          <div class="modal-body">

            <div class="form-group">
              <label for="nome">Nome <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="nome" id="nome" value="<?= $item["nome"] ?>" placeholder="Nome da categoria" required>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" id="btnEditCategoria" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<?= $this->endSection() ?>