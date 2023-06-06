let cards = "";
let card_color = "";
let produto = "";
let filtro_data = "";

$().ready(() => {
  request();
});

$("#data").change(function () {
  filtro_data = $("#data").val();
  limparKanban();
  request();
});

function request() {
  $.ajax({
    url: window.location.href + `/kanban${filtro_data != "" ? `?data=${filtro_data}` : ""}`,
    "dataType": "json",
    "type": "GET",
    success: function (response) {
      data = response;
      console.log(data);

      for (let i = 0; i < data.fazer.length; i++) {
        card(data.fazer[i]);
        for (let y = 0; y < data.fazer[i].produtos.length; y++) {
          produtos(data.fazer[i].id, data.fazer[i].produtos[y]);
        }
      }
      for (let i = 0; i < data.fazendo.length; i++) {
        card(data.fazendo[i]);
        for (let y = 0; y < data.fazendo[i].produtos.length; y++) {
          produtos(data.fazendo[i].id, data.fazendo[i].produtos[y]);
        }
      }
      for (let i = 0; i < data.feito.length; i++) {
        card(data.feito[i]);
        for (let y = 0; y < data.feito[i].produtos.length; y++) {
          produtos(data.feito[i].id, data.feito[i].produtos[y]);
        }
      }
    }
  });
}

function card(data) {
  if (data.status == "P") {
    card_color = "primary";
  } else if (data.status == "E") {
    card_color = "warning";
  } else if (data.status == "R") {
    card_color = "success";
  }

  cards = `
    <div class="card card-${card_color} card-outline">
        <div class="card-header">
          <h3 class="card-title">Pedido #${data.codigo == '' ? data.id : data.codigo}</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>

        <div class="card-body">
          <div class="d-flex flex-column" style="gap: 10px;">

              <div id="produtos-${data.id}" style="display: contents;"></div>

              <hr class="w-100 m-0">

              <div class="d-flex flex-column">
                <span><strong>CEP:</strong> ${data.cep}</span>
                <span><strong>CLIENTE:</strong> ${data.usuario_nome}</span>
                <span><strong>ENDEREÇO:</strong> ${data.endereco}, ${data.numero}</span>
                ${data.complemento != "" ? `<span><strong>COMPLEMENTO:</strong> ${data.complemento} </span>` : ''}
              </div>

              <hr class="w-100 m-0">

              <div class="d-flex flex-column">
              <span><strong>FRETE:</strong>R$ ${data.frete}</span>
              <span><strong>TOTAL:</strong>R$ ${data.total}</span>
              <span><strong>DATA PEDIDO:</strong> ${data.data}</span>
            </div>

          </div>
        </div>

        <div class="card-footer">
          <div class="btn-group w-100">

            <button class="btn btn-danger ${data.status == 'R' ? 'disabled opacity-25' : ''}"
            ${data.status == 'R' ? 'disabled' : ''}
              title="CANCELAR PEDIDO"
              onclick="setStatus(${data.id}, 'F')">
              <i class="fas fa-times"></i>
            </button>

            <button class="btn btn-warning ${data.status == 'R' || data.status == 'E' ? 'disabled opacity-25' : ''}"
            ${data.status == 'R' || data.status == 'E' ? 'disabled' : ''}
              title="MOVER PARA EM ROTA"
              onclick="setStatus(${data.id}, 'E')">
              <i class="fas fa-arrow-right"></i>
            </button>

            <button class="btn btn-success ${data.status == 'P' || data.status == 'R' ? 'disabled opacity-25' : ''}"
            ${data.status == 'P' || data.status == 'R' ? 'disabled' : ''}
              title="PEDIDO RECEBIDO" 
              onclick="setStatus(${data.id}, 'R')">
              <i class="fas fa-check"></i>
            </button>

          </div>
        </div>
    </div>
  `;

  if (data.status == "P") {
    $("#card-fazer").append(cards);
  } else if (data.status == "E") {
    $("#card-fazendo").append(cards);
  } else if (data.status == "R") {
    $("#card-feito").append(cards);
  }
}

function produtos(id, data) {

  produto = `
  <div class="d-flex align-items-center" style="gap: 5px;">
  <img class="rounded" width="40" src="${data.foto}">
  <div class="d-flex w-100 justify-content-between">
    <span>${data.nome}</span>
    <span>x ${data.quantidade}</span>
  </div>
</div>`;

  $("#produtos-" + id).append(produto);
}

function setStatus(pedidoId, status) {
  $("#produtos-" + pedidoId).empty("");
  limparKanban();

  $.ajax({
    url: window.location.href + `/pedido/${pedidoId}/status/${status}`,
    "dataType": "json",
    "type": "GET",
    success: function (response) {
    }
  });

  request();
}

function limparKanban() {
  $("#card-fazer").empty("");
  $("#card-fazendo").empty("");
  $("#card-feito").empty("");
}