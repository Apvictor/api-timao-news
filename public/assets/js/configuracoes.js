
$("#cep").change(function () {
  if (this.value.length >= 8) {
    request(this.value);
  }
});

function request(cep) {

  $.ajax({
    url: `http://cep.republicavirtual.com.br/web_cep.php?cep=${cep}&formato=json`,
    "dataType": "json",
    "type": "GET",
    success: function (response) {
      $("#endereco").val(response.tipo_logradouro + " " + response.logradouro);
      $("#cidade").val(response.cidade);
      $(`#estado option[value=${response.uf}]`).attr("selected", "selected");
    }
  });
}