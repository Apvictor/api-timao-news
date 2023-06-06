$("#formAddCategoria").validate({
  rules: {
    nome: { required: true },
  },
  messages: {
    nome: { required: "Campo obrigatório" },
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

    // let data = {
    //   nome: $("#nome").val(),
    // };

    $("#btnAddCategoria").attr("disabled", "disabled").html(`<i class="fas fa-circle-notch fa-spin"></i>`);

    // $.ajax({
    //   type: "POST",
    //   url: "/admin/categorias/cadastrar",
    //   data: data,
    //   success: function (response) {
    //     toast(response.toast.title, response.toast.message, response.toast.type);
    //   },
    // });
  }
});

// EDIT

$("#formEditCategoria").validate({
  rules: {
    nome: { required: true },
  },
  messages: {
    nome: { required: "Campo obrigatório" },
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

    // let data = {
    //   nome: $("#nome").val(),
    // };

    $("#btnEditCategoria").attr("disabled", "disabled").html(`<i class="fas fa-circle-notch fa-spin"></i>`);

    // $.ajax({
    //   type: "POST",
    //   url: "/admin/categorias/cadastrar",
    //   data: data,
    //   success: function (response) {
    //     toast(response.toast.title, response.toast.message, response.toast.type);
    //   },
    // });
  }
});
