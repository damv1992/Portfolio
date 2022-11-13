$('.experiencia').removeClass('btn-secondary');
$('.experiencia').addClass('btn-primary');
let controlador = '/experiencia';
let presente = 0;
$('.fechaFin').show();

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

/* EDITOR TIPO DOCUMENTO */
let funciones;
DecoupledEditor.create(document.querySelector('[name=funciones]')).then(editor => {
    const toolbarContainer = document.querySelector('#herramientas');
    toolbarContainer.appendChild(editor.ui.view.toolbar.element);
    funciones = editor;
}).catch(error => {
    console.error(error);
});

$('.btnGuardar').click(function () {
    let datos = new FormData($('.form')[0]);
    datos.append('presente', presente);
    datos.append('funciones', funciones.getData());
    guardar(controlador, datos);
    return false;
});

$(".tabla tbody").on("click", ".btnBorrar", function () {
    let id = $(this).attr("codigo");
    let datos = new FormData();
    datos.append("id", id);
    borrar(controlador, datos);
});