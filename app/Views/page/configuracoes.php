<?= $this->extend('layout/template') ?>

<?= $this->section('template') ?>
<section class="content">
  <div class="container-fluid">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Dados Empresa</h3>
      </div>
      <form action="<?= base_url("admin/configuracoes/" . $sistema["id"] . "/editar") ?>" method="post" enctype="multipart/form-data">
        <div class="card-body">

          <div class="row">
            <div class="col">
              <img class="rounded" height="80" src="<?= $sistema["foto"] ?>" alt="<?= $sistema["nome_fantasia"] ?>">
              <div class="form-group mt-2">
                <input type="file" name="foto" class="form-control-file" id="foto">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm">
              <div class="form-group">
                <label>Nome Fantasia</label>
                <input type="text" class="form-control" name="nome_fantasia" placeholder="Digite o nome fantasia" value="<?= $sistema["nome_fantasia"] ?>">
              </div>
            </div>

            <div class="col-sm">
              <div class="form-group">
                <label>Razão Social</label>
                <input type="text" class="form-control" name="razao_social" placeholder="Digite a razão social" value="<?= $sistema["razao_social"] ?>">
              </div>
            </div>

            <div class="col-sm">
              <div class="form-group">
                <label>CNPJ</label>
                <input type="text" class="form-control" name="cnpj" placeholder="Digite o cnpj" value="<?= format_cpf_cnpj($sistema["cnpj"]) ?>">
              </div>
            </div>

            <div class="col-sm">
              <div class="form-group">
                <label>Ramo de atividade</label>
                <select name="ramo_sistema" class="form-control">
                  <option <?= $sistema["ramo_sistema"] == "adega" ? "selected" : "" ?> value="adega">Adega</option>
                  <option <?= $sistema["ramo_sistema"] == "açaiteria" ? "selected" : "" ?> value="açaiteria">Açaiteria</option>
                  <option <?= $sistema["ramo_sistema"] == "confeitaria" ? "selected" : "" ?> value="confeitaria">Confeitaria</option>
                  <option <?= $sistema["ramo_sistema"] == "hortifruti" ? "selected" : "" ?> value="hortifruti">Hortifruti</option>
                  <option <?= $sistema["ramo_sistema"] == "hamburgueria" ? "selected" : "" ?> value="hamburgueria">Hamburgueria</option>
                  <option <?= $sistema["ramo_sistema"] == "pizzaria" ? "selected" : "" ?> value="pizzaria">Pizzaria</option>
                  <option <?= $sistema["ramo_sistema"] == "restaurante" ? "selected" : "" ?> value="restaurante">Restaurante</option>
                </select>
              </div>
            </div>

          </div>

          <div class="row">

            <div class="col-sm col-lg-3">
              <div class="form-group">
                <label>Cor do fundo principal</label>
                <input class="form-control" type="color" id="cor_primaria" name="cor_primaria" list="cor_primaria" value="<?= $sistema["cor_primaria"] ?>">
                <datalist id="cor_primaria">
                  <option value="#F8D849"></option>
                  <option value="#6A5ACD"></option>
                  <option value="#FFC0CB"></option>
                  <option value="#DC143C"></option>
                  <option value="#09b54d"></option>
                  <option value="#FFA500"></option>
                  <option value="#8B4513"></option>
                </datalist>
              </div>
            </div>

            <div class="col-sm col-lg-3">
              <div class="form-group">
                <label>Cor do texto sobre o fundo</label>
                <input class="form-control" type="color" id="cor_texto" name="cor_texto" list="cor_texto" value="<?= $sistema["cor_texto"] ?>">
                <datalist id="cor_texto">
                  <option value="#F8D849"></option>
                  <option value="#6A5ACD"></option>
                  <option value="#FFC0CB"></option>
                  <option value="#DC143C"></option>
                  <option value="#09b54d"></option>
                  <option value="#FFA500"></option>
                  <option value="#8B4513"></option>
                </datalist>
              </div>
            </div>

          </div>

        </div>


        <div class="card-footer d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Atualizar Empresa</button>
        </div>
      </form>
    </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Contatos</h3>
      </div>
      <form action="<?= base_url("admin/configuracoes/" . $sistema["id"] . "/editar") ?>" method="post">

        <div class="card-body">

          <div class="row">

            <div class="col-sm">
              <div class="form-group">
                <label>E-mail</label>
                <input disabled type="email" class="form-control" name="email" placeholder="Digite o email" value="<?= $sistema["email"] ?>">
              </div>
            </div>

            <div class="col-sm">
              <div class="form-group">
                <label>Telefone</label>
                <input class="form-control phone" name="telefone" placeholder="Digite o telefone" value="<?= format_phone($sistema["telefone"]) ?>">
              </div>
            </div>
          </div>

        </div>

        <div class="card-footer d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Atualizar Contatos</button>
        </div>
      </form>
    </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Endereços</h3>
      </div>
      <form action="<?= base_url("admin/configuracoes/" . $sistema["id"] . "/editar") ?>" method="post">

        <div class="card-body">

          <div class="row">
            <div class="col-sm">
              <div class="form-group">
                <label>CEP</label>
                <input id="cep" name="cep" class="form-control cep" placeholder="Digite o CEP" value="<?= $sistema["cep"] ?>" required>
              </div>
            </div>
            <div class="col-sm">
              <div class="form-group">
                <label>Rua</label>
                <input type="text" id="endereco" name="endereco" class="form-control" placeholder="Digite a rua" value="<?= $sistema["endereco"] ?>" required>
              </div>
            </div>
            <div class="col-sm">
              <div class="form-group">
                <label>Número</label>
                <input type="number" name="numero" class="form-control" placeholder="Digite o número" value="<?= $sistema["numero"] ?>" required>
              </div>
            </div>
            <div class="col-sm">
              <div class="form-group">
                <label>Cidade</label>
                <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Digite a cidade" value="<?= $sistema["cidade"] ?>" required>
              </div>
            </div>

            <div class="col-sm">
              <div class="form-group">
                <label>Estado</label>
                <select id="estado" name="estado" class="form-control">
                  <option <?= $sistema["estado"] == "AC" ? "selected" : "" ?> value="AC">Acre</option>
                  <option <?= $sistema["estado"] == "AL" ? "selected" : "" ?> value="AL">Alagoas</option>
                  <option <?= $sistema["estado"] == "AP" ? "selected" : "" ?> value="AP">Amapá</option>
                  <option <?= $sistema["estado"] == "AM" ? "selected" : "" ?> value="AM">Amazonas</option>
                  <option <?= $sistema["estado"] == "BA" ? "selected" : "" ?> value="BA">Bahia</option>
                  <option <?= $sistema["estado"] == "CE" ? "selected" : "" ?> value="CE">Ceará</option>
                  <option <?= $sistema["estado"] == "DF" ? "selected" : "" ?> value="DF">Distrito Federal</option>
                  <option <?= $sistema["estado"] == "ES" ? "selected" : "" ?> value="ES">Espírito Santo</option>
                  <option <?= $sistema["estado"] == "GO" ? "selected" : "" ?> value="GO">Goiás</option>
                  <option <?= $sistema["estado"] == "MA" ? "selected" : "" ?> value="MA">Maranhão</option>
                  <option <?= $sistema["estado"] == "MT" ? "selected" : "" ?> value="MT">Mato Grosso</option>
                  <option <?= $sistema["estado"] == "MS" ? "selected" : "" ?> value="MS">Mato Grosso do Sul</option>
                  <option <?= $sistema["estado"] == "MG" ? "selected" : "" ?> value="MG">Minas Gerais</option>
                  <option <?= $sistema["estado"] == "PA" ? "selected" : "" ?> value="PA">Pará</option>
                  <option <?= $sistema["estado"] == "PB" ? "selected" : "" ?> value="PB">Paraíba</option>
                  <option <?= $sistema["estado"] == "PR" ? "selected" : "" ?> value="PR">Paraná</option>
                  <option <?= $sistema["estado"] == "PE" ? "selected" : "" ?> value="PE">Pernambuco</option>
                  <option <?= $sistema["estado"] == "PI" ? "selected" : "" ?> value="PI">Piauí</option>
                  <option <?= $sistema["estado"] == "RJ" ? "selected" : "" ?> value="RJ">Rio de Janeiro</option>
                  <option <?= $sistema["estado"] == "RN" ? "selected" : "" ?> value="RN">Rio Grande do Norte</option>
                  <option <?= $sistema["estado"] == "RS" ? "selected" : "" ?> value="RS">Rio Grande do Sul</option>
                  <option <?= $sistema["estado"] == "RO" ? "selected" : "" ?> value="RO">Rondônia</option>
                  <option <?= $sistema["estado"] == "RR" ? "selected" : "" ?> value="RR">Roraima</option>
                  <option <?= $sistema["estado"] == "SC" ? "selected" : "" ?> value="SC">Santa Catarina</option>
                  <option <?= $sistema["estado"] == "SP" ? "selected" : "" ?> value="SP">São Paulo</option>
                  <option <?= $sistema["estado"] == "SE" ? "selected" : "" ?> value="SE">Sergipe</option>
                  <option <?= $sistema["estado"] == "TO" ? "selected" : "" ?> value="TO">Tocantins</option>
                </select>
              </div>
            </div>

          </div>

        </div>

        <div class="card-footer d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Atualizar Endereço</button>
        </div>
      </form>
    </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Configuração Entrega</h3>
      </div>
      <form action="<?= base_url("admin/configuracoes/" . $sistema["id"] . "/editar") ?>" method="post">

        <div class="card-body">
          <div class="row">

            <div class="col-sm">
              <div class="form-group">
                <label>Tempo mínimo de Entrega (minutos)</label>
                <input type="number" name="tempo_entrega_min" class="form-control" placeholder="Entrega minimo" value="<?= $sistema["tempo_entrega_min"] ?>">
              </div>
            </div>

            <div class="col-sm">
              <div class="form-group">
                <label>Tempo máximo de Entrega (minutos)</label>
                <input type="number" name="tempo_entrega_max" class="form-control" placeholder="Entrega maximo" value="<?= $sistema["tempo_entrega_max"] ?>">
              </div>
            </div>

            <div class="col-sm">
              <div class="form-group">
                <label>Chave PIX</label>
                <input type="text" name="pix" class="form-control" placeholder="Digite a chave pix" value="<?= $sistema["pix"] ?>">
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Atualizar Entrega</button>
        </div>
      </form>

    </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Configuração Disponibilidade</h3>
      </div>
      <form action="<?= base_url("admin/configuracoes/" . $sistema["id"] . "/editar") ?>" method="post">

        <div class="card-body">
          <div class="row">

            <div class="col-sm">
              <div class="form-group">
                <label>Horário de abertura</label>
                <input type="time" name="aberto" class="form-control" placeholder="Digite o horário de abertura" value="<?= $sistema["aberto"] ?>">
              </div>
            </div>

            <div class="col-sm">
              <div class="form-group">
                <label>Horário de fechamento</label>
                <input type="time" name="fechado" class="form-control" placeholder="Digite o horário de fechamento" value="<?= $sistema["fechado"] ?>">
              </div>
            </div>

          </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Atualizar Horários</button>
        </div>
      </form>

    </div>

  </div>
</section>
<?= $this->endSection() ?>