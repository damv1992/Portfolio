$('.pagina').removeClass('btn-secondary');
$('.pagina').addClass('btn-primary');
let controlador = '/pagina';

$('[name=icono]').change(function () {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#verIcono').show();
            $('#verIcono').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    } else $('#verIcono').hide();
});

$('[name=fondo]').change(function () {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#verFondo').show();
            $('#verFondo').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    } else $('#verFondo').hide();
});

$('.btnGuardar').click(function () {
    let datos = new FormData($('.form')[0]);
    datos.set('icono', $("[name=icono]").prop('files')[0]);
    datos.set('fondo', $("[name=fondo]").prop('files')[0]);
    guardar(controlador, datos);
    return false;
});