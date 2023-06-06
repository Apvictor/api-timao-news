$("#formAdd").validate({
  rules: {
    nome: { required: true },
    desconto: { required: true },
  },
  messages: {
    nome: { required: "Campo obrigatório" },
    desconto: { required: "Campo obrigatório" },
  },
  errorClass: 'is-invalid',
  validClass: "is-valid",
  errorElement: "span",
  errorPlacement: function (error, element) {
    $(element)
      .closest(".form-group")
      .find(".invalid-feedback")
      .append(error);
  },
  submitHandler: async function () {
    $("#btnAdd").attr("disabled", "disabled").html(`<i class="fas fa-circle-notch fa-spin"></i>`);
  }
});

$("#nome").change(function () {
  $("#codigo").val(this.value.trim().split(" ").join("_").toUpperCase());
});

// EDIT

$("#formEdit").validate({
  rules: {
    nome: { required: true },
    desconto: { required: true },
  },
  messages: {
    nome: { required: "Campo obrigatório" },
    desconto: { required: "Campo obrigatório" },
  },
  errorClass: 'is-invalid',
  validClass: "is-valid",
  errorElement: "span",
  errorPlacement: function (error, element) {
    $(element)
      .closest(".form-group")
      .find(".invalid-feedback")
      .append(error);
  },
  submitHandler: async function () {
    $("#btnEdit").attr("disabled", "disabled").html(`<i class="fas fa-circle-notch fa-spin"></i>`);
  }
});

$("#nome_edit").change(function () {
  $("#codigo_edit").val(this.value.trim().split(" ").join("_").toUpperCase());
});
