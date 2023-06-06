<?= $this->extend('layout/template') ?>


<?= $this->section('template') ?>

<section class="content">
  <div class="container-fluid">

    <div class="row">

      <div class="col-lg-3 col-6">
        <a href="<?= base_url("admin/usuarios") ?>" class="small-box bg-info">
          <div class="inner">
            <h3><?= $total_usuarios ?></h3>
            <p>Total de Clientes</p>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-6">
        <a href="<?= base_url("admin/pedidos") ?>" class="small-box bg-danger">
          <div class="inner">
            <h3><?= $total_pedidos ?></h3>
            <p>Total de Pedidos</p>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-6">
        <a href="<?= base_url("admin/categorias") ?>" class="small-box bg-warning">
          <div class="inner">
            <h3><?= $total_categorias ?></h3>
            <p>Total de Categorias</p>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-6">
        <a href="<?= base_url("admin/produtos") ?>" class="small-box bg-success">
          <div class="inner">
            <h3><?= $total_produtos ?></h3>
            <p>Total de Produtos</p>
          </div>
        </a>
      </div>

    </div>

    <!-- <div class="row"> -->

    <!-- PRODUTOS MAIS VENDIDOS -->
    <!-- <div class="col-md-3">
        <div class="card">
          <div class="card-header border-0">
            <strong>Produtos mais vendidos</strong>
          </div>

          <div class="card-body">
            <div class="progress-group">
              Add Products to Cart
              <span class="float-right"><b>160</b>/200</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-primary" style="width: 80%"></div>
              </div>
            </div>

            <div class="progress-group">
              Complete Purchase
              <span class="float-right"><b>310</b>/400</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-danger" style="width: 75%"></div>
              </div>
            </div>

            <div class="progress-group">
              <span class="progress-text">Visit Premium Page</span>
              <span class="float-right"><b>480</b>/800</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-success" style="width: 60%"></div>
              </div>
            </div>

            <div class="progress-group">
              Send Inquiries
              <span class="float-right"><b>250</b>/500</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-warning" style="width: 50%"></div>
              </div>
            </div>
          </div>
        </div>
      </div> -->

    <!-- PRODUTOS MENOS VENDIDOS -->
    <!-- <div class="col-md-3">
        <div class="card">
          <div class="card-header border-0">
            <strong>Produtos menos vendidos</strong>
          </div>

          <div class="card-body">
            <div class="progress-group">
              Add Products to Cart
              <span class="float-right"><b>160</b>/200</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-primary" style="width: 80%"></div>
              </div>
            </div>

            <div class="progress-group">
              Complete Purchase
              <span class="float-right"><b>310</b>/400</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-danger" style="width: 75%"></div>
              </div>
            </div>

            <div class="progress-group">
              <span class="progress-text">Visit Premium Page</span>
              <span class="float-right"><b>480</b>/800</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-success" style="width: 60%"></div>
              </div>
            </div>

            <div class="progress-group">
              Send Inquiries
              <span class="float-right"><b>250</b>/500</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-warning" style="width: 50%"></div>
              </div>
            </div>
          </div>
        </div>
      </div> -->

    <!-- PRODUTOS MAIS AVALIADOS -->
    <!-- <div class="col-md-3">
        <div class="card">
          <div class="card-header border-0">
            <strong>Produtos mais avaliados</strong>
          </div>

          <div class="card-body">
            <div class="progress-group">
              Add Products to Cart
              <span class="float-right"><b>160</b>/200</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-primary" style="width: 80%"></div>
              </div>
            </div>

            <div class="progress-group">
              Complete Purchase
              <span class="float-right"><b>310</b>/400</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-danger" style="width: 75%"></div>
              </div>
            </div>

            <div class="progress-group">
              <span class="progress-text">Visit Premium Page</span>
              <span class="float-right"><b>480</b>/800</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-success" style="width: 60%"></div>
              </div>
            </div>

            <div class="progress-group">
              Send Inquiries
              <span class="float-right"><b>250</b>/500</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-warning" style="width: 50%"></div>
              </div>
            </div>
          </div>
        </div>
      </div> -->

    <!-- PRODUTOS MENOS AVALIADOS -->
    <!-- <div class="col-md-3">
        <div class="card">
          <div class="card-header border-0">
            <strong>Produtos menos avaliados</strong>
          </div>

          <div class="card-body">
            <div class="progress-group">
              Add Products to Cart
              <span class="float-right"><b>160</b>/200</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-primary" style="width: 80%"></div>
              </div>
            </div>

            <div class="progress-group">
              Complete Purchase
              <span class="float-right"><b>310</b>/400</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-danger" style="width: 75%"></div>
              </div>
            </div>

            <div class="progress-group">
              <span class="progress-text">Visit Premium Page</span>
              <span class="float-right"><b>480</b>/800</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-success" style="width: 60%"></div>
              </div>
            </div>

            <div class="progress-group">
              Send Inquiries
              <span class="float-right"><b>250</b>/500</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-warning" style="width: 50%"></div>
              </div>
            </div>
          </div>
        </div>
      </div> -->

    <!-- </div> -->

    <div class="row">
      <div class="col-lg-6">

        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title">Produtos com estoque baixo</h3>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Produto</th>
                  <th>Qtde</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($estoque_produtos as $item) : ?>
                  <tr>
                    <td>
                      <?= $item["id"] ?>
                    </td>
                    <td>
                      <img src="<?= $item["foto"] ?>" alt="<?= $item["nome"] ?>" class="img-circle img-size-32 mr-2">
                      <?= $item["nome"] ?>
                    </td>
                    <td>
                      <?= $item["quantidade"] ?>
                    </td>
                    <td>
                      <a href="<?= base_url("admin/produtos/" . $item["id"] . "/status?redirect=dashboard") ?>">
                        <span class="badge badge-<?= $item["status"] == ATIVO ? "success" : "danger" ?>">
                          <?= $item["status"] == ATIVO ? "ATIVO" : "INATIVO" ?>
                        </span>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- GRÁFICO -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Gráfico da empresa</h3>

              <select id="ano" name="ano" class="custom-select w-25">
                <?php for ($i = 0; $i < 5; $i++) : ?>
                  <option value="<?= date("Y") - $i ?>"><?= date("Y") - $i ?></option>
                <?php endfor; ?>
              </select>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex">
              <p class="d-flex flex-column">
                <span id="soma-total-pedidos" class="text-bold text-lg"></span>
                <span>Faturamento</span>
              </p>
              <p class="ml-auto d-flex flex-column text-right">
                <span class="text-success">
                  <i class="fas fa-arrow-up"></i>
                  <span id="porcentagem-pedidos"></span>
                </span>
                <span class="text-muted">Desde o último mês</span>
              </p>
            </div>

            <div class="position-relative mb-4">
              <div class="chartjs-size-monitor">
                <div class="chartjs-size-monitor-expand">
                  <div class=""></div>
                </div>
                <div class="chartjs-size-monitor-shrink">
                  <div class=""></div>
                </div>
              </div>
              <canvas id="sales-chart" height="250" style="display: block; height: 200px; width: 336px;" width="420" class="chartjs-render-monitor"></canvas>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>

<?= $this->endSection() ?>