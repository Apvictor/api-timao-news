<?= $this->extend('layout/template') ?>

<?= $this->section('template') ?>
<section class="content">
  <div class="container-fluid">

    <div class="card">
      <div class="card-header">
        <form action="<?= base_url("admin/pedidos") ?>" method="get" class="form form-inline">
          <div class="d-flex justify-content-between w-100">
            <div class="d-flex flex-md-row flex-column w-100" style="gap: 5px;">

              <select class="custom-select" id="status" name="status">
                <option value="">Selecione um status</option>
                <option value="P" <?= isset($filtros["status"]) && $filtros["status"] == PENDENTE ? "selected" : "" ?>>Fazendo</option>
                <option value="E" <?= isset($filtros["status"]) && $filtros["status"] == ENTREGA ? "selected" : "" ?>>Em Rota</option>
                <option value="R" <?= isset($filtros["status"]) && $filtros["status"] == RECEBIDO ? "selected" : "" ?>>Recebido</option>
                <option value="F" <?= isset($filtros["status"]) && $filtros["status"] == FALHA ? "selected" : "" ?>>Cancelado</option>
              </select>

              <input type="search" name="search" placeholder="Pesquisar" class="form-control" value="<?= isset($filtros["search"]) ? $filtros["search"] : "" ?>">
              <button type="submit" class="btn btn-dark">
                Filtrar
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-condensed">
          <thead>
            <tr>
              <th>#</th>
              <th>Data</th>
              <th>Cliente</th>
              <th>Endereço</th>
              <th>Forma de Pagamento</th>
              <th>Frete</th>
              <th>Total</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($pedidos as $item) : ?>
              <tr>
                <td><?= $item["codigo"] == null ? $item["id"] : $item["codigo"] ?></td>
                <td><?= format_date($item["data"], "d/m/Y H:i:s") ?></td>
                <td><?= $item["usuario_nome"] ?></td>
                <td><?= $item["endereco"] ?></td>
                <td><?= $item["forma_pagamento"] ?></td>
                <td><?= format_money($item["frete"]) ?></td>
                <td><?= format_money($item["total"]) ?></td>
                <td>
                  <?php if ($item["status"] === PENDENTE) : ?>
                    <a href="#" title="PEDIDO PENDENTE">
                      <span class="badge badge-primary">PEDIDO PENDENTE</span>
                    </a>
                  <?php elseif ($item["status"] === RECEBIDO) : ?>
                    <a href="#" title="PEDIDO RECEBIDO">
                      <span class="badge badge-success">PEDIDO RECEBIDO</span>
                    </a>
                  <?php elseif ($item["status"] === FALHA) : ?>
                    <a href="#" title="PEDIDO CANCELADO">
                      <span class="badge badge-danger">PEDIDO CANCELADO</span>
                    </a>
                  <?php elseif ($item["status"] === ENTREGA) : ?>
                    <a href="#" title="PEDIDO EM ROTA">
                      <span class="badge badge-warning">PEDIDO EM ROTA</span>
                    </a>
                  <?php endif; ?>
                </td>

                <td>
                  <?php if (!$item["comprovante"] == null) : ?>
                    <a href="<?= $item["comprovante"] ?>" target="_blank" class="btn btn-dark" title="COMPROVANTE DO PIX">
                      <i class="fa fa-file-pdf"></i>
                    </a>
                  <?php endif; ?>
                <td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</section>


<?= $this->endSection() ?>