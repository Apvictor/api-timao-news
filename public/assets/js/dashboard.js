const ctx = document.getElementById('sales-chart');

let barChart = "";
let data = [];
let ano = "";

$().ready(() => {
  ano = $("#ano").val();
  request(ano);
});

$("#ano").change(function () {
  ano = $("#ano").val();
  data = [];
  barChart.destroy();
  request(ano);
});

function request(ano) {
  $.ajax({
    url: window.location.href + `/graphic/${ano}`,
    "dataType": "json",
    "type": "GET",
    success: function (response) {
      data = response;
      $("#soma-total-pedidos").html(data["soma_total_pedidos"]);
      $("#porcentagem-pedidos").html(`${data["porcentagem_pedidos"]}%`);

      $("#total_discounts").html(data["total_discounts"])
      $("#total_salaries").html(data["total_salaries"])
      $("#total_net_value").html(data["total_net_value"])

      graphic(data);
    }
  });
}

function graphic(data) {
  console.log(data);
  barChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'], datasets: [
        {
          label: 'Clientes',
          backgroundColor: '#0dcaf0',
          borderColor: '#FFF',
          data: data["chart"]["chart_clientes"]
        },
        {
          label: 'Pedidos',
          backgroundColor: '#dc3545',
          borderColor: '#FFF',
          data: data["chart"]["chart_pedidos"]
        },
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      datasetFill: false,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  });
}