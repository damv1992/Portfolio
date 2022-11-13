$('.habilidad').removeClass('btn-secondary');
$('.habilidad').addClass('btn-primary');
let controlador = '/habilidad';

cargarTabla(controlador);

$('.btnGuardar').click(function () {
    let datos = new FormData($('.form')[0]);
    guardar(controlador, datos);
    return false;
});

$(".tabla tbody").on("click", ".btnBorrar", function () {
    let id = $(this).attr("codigo");
    let datos = new FormData();
    datos.append("id", id);
    borrar(controlador, datos);
});