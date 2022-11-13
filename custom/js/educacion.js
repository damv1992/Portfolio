$('.educacion').removeClass('btn-secondary');
$('.educacion').addClass('btn-primary');
let controlador = '/educacion';
let presente = 0;
$('.fechaFin').hide();

cargarTabla(controlador);

if ($('[name=presente]').prop('checked')) {
    presente = 1;
    $('.fechaFin').hide();
} else {
    presente = 0;
    $('.fechaFin').show();
}
$('[name=presente]').change(function () {
    if ($('[name=presente]').prop('checked')) {
        presente = 1;
        $('.fechaFin').hide();
    } else {
        presente = 0;
        $('.fechaFin').show();
    }
});

$('.btnGuardar').click(function () {
    let datos = new FormData($('.form')[0]);
    datos.append('presente', presente);
    guardar(controlador, datos);
    return false;
});

$(".tabla tbody").on("click", ".btnBorrar", function () {
    let id = $(this).attr("codigo");
    let datos = new FormData();
    datos.append("id", id);
    borrar(controlador, datos);
});