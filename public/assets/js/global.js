
function toast(title = "", message = "", type = "", position = "topRight") {
  switch (type) {
    case "info":
      iziToast.info({ title, message, position });
      break;
    case "error":
      iziToast.error({ title, message, position });
      break;
    case "warning":
      iziToast.warning({ title, message, position });
      break;
    case "success":
      iziToast.success({ title, message, position });
      break;
    default:
      iziToast.show({ title, message, position });
      break;
  }
}

$(function () {
  $('.money').mask('000.000.000.000.000,00', { reverse: true });
  $('.phone').mask('(00) 00000-0000', { reverse: false });
  $('.cep').mask('00000-000', { reverse: false });
});