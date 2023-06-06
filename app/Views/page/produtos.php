<?= $this->extend('layout/template') ?>

<?= $this->section('template') ?>
<section class="content">
  <div class="container-fluid">

    <div class="card">
      <div class="card-header">
        <form action="<?= base_url("admin/produtos") ?>" method="get" class="form form-inline">
          <div class="d-flex flex-md-row flex-column justify-content-between w-100">
            <div class="d-flex flex-md-row flex-column w-100 mb-md-0 mb-1" style="gap: 5px;">

              <select class="custom-select" id="categoria_id" name="categoria_id">
                <option value="">Selecione uma categoria</option>
                <?php foreach ($categorias as $value) : ?>
                  <option value="<?= $value["id"] ?>" <?= isset($filtros["categoria_id"]) && $filtros["categoria_id"] === $value["id"] ? "selected" : "" ?>>
                    <?= $value["nome"] ?>
                  </option>
                <?php endforeach; ?>
              </select>

              <input type="search" name="search" placeholder="Pesquisar" class="form-control" value="<?= isset($filtros["search"]) ? $filtros["search"] : "" ?>">

              <button type="submit" class="btn btn-dark">
                Filtrar
              </button>

            </div>

            <button type="button" class="btn btn-dark" title="Adicionar" data-toggle="modal" data-target="#add-produto">
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
              <th>Categoria</th>
              <th>Preço</th>
              <th>Quantidade</th>
              <th>Status</th>
              <th width="150">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($produtos as $item) : ?>
              <tr>
                <td><?= $item["id"] ?></td>
                <td>
                  <img height="32" src="<?= $item["foto"] ?>" alt="<?= $item["nome"] ?>">
                  <?= $item["nome"] ?>
                </td>
                <td><?= $item["categoria_nome"] ?></td>
                <td><?= format_money($item["preco"]) ?></td>
                <td><?= $item["quantidade"] ?></td>
                <td>
                  <a href="<?= base_url("admin/produtos/" . $item["id"] . "/status") ?>">
                    <span class="badge badge-<?= $item["status"] == ATIVO ? "success" : "danger" ?>">
                      <?= $item["status"] == ATIVO ? "ATIVO" : "INATIVO" ?>
                    </span>
                  </a>
                </td>
                <td>
                  <button type="button" class="btn btn-info" title="Editar" data-toggle="modal" data-target="#edit-produto-<?= $item["id"] ?>">
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
<div class="modal fade" id="add-produto" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Adicionar produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url("admin/produtos/cadastrar") ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="nome">Nome<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do produto" required />
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label for="quantidade">Qtde<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="quantidade" id="quantidade" min="0" required />
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col">
              <div class="form-group">
                <label for="categoria_id">Categoria<span class="text-danger">*</span></label>
                <select class="custom-select" id="categoria_id" name="categoria_id" required>
                  <option value="">Selecione</option>
                  <?php foreach ($categorias as $value) : ?>
                    <option value="<?= $value["id"] ?>"><?= $value["nome"] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="col-3">
              <div class="form-group">
                <label for="preco">Preço<span class="text-danger">*</span></label>
                <input type="text" class="form-control money" name="preco" id="preco" min="0" required />
              </div>
            </div>

          </div>

          <div class="form-group">
            <label for="foto">Foto<span class="text-danger">*</span></label>
            <input type="file" class="form-control-file" id="foto" name="foto" required />
          </div>

          <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
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
<?php foreach ($produtos as $item) : ?>
  <div class="modal fade" id="edit-produto-<?= $item["id"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar produto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url("admin/produtos/" . $item["id"] . "/editar") ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">

            <div class="row">

              <div class="col">
                <div class="form-group">
                  <label for="nome">Nome<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="nome" id="nome" value="<?= $item["nome"] ?>" placeholder="Nome do produto" required />
                </div>
              </div>

              <div class="col-3">
                <div class="form-group">
                  <label for="quantidade">Qtde<span class="text-danger">*</span></label>
                  <input type="number" class="form-control" name="quantidade" id="quantidade" value="<?= $item["quantidade"] ?>" min="0" required />
                </div>
              </div>

            </div>

            <div class="row">

              <div class="col">
                <div class="form-group">
                  <label for="categoria_id">Categoria<span class="text-danger">*</span></label>
                  <select class="custom-select" id="categoria_id" name="categoria_id" required>
                    <option value="">Selecione</option>
                    <?php foreach ($categorias as $value) : ?>
                      <option value="<?= $value["id"] ?>" <?= $item["categoria_id"] == $value["id"] ? "selected" : "" ?>>
                        <?= $value["nome"] ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="preco">Preço<span class="text-danger">*</span></label>
                  <input type="text" class="form-control money" name="preco" id="preco" value="<?= $item["preco"] ?>" min="0" required />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="foto">Foto<span class="text-danger">*</span></label>
              <div class="d-flex">
                <img height="32" src="<?= $item["foto"] ?>" alt="<?= $item["nome"] ?>">
                <input type="file" class="form-control-file" id="foto" name="foto" value="<?= $item["foto"] ?>" />
              </div>
            </div>

            <div class="form-group">
              <label for="descricao">Descrição</label>
              <textarea class="form-control" id="descricao" name="descricao" rows="3"><?= $item["descricao"] ?></textarea>
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