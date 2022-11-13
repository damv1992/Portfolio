$('.proyecto').removeClass('btn-secondary');
$('.proyecto').addClass('btn-primary');
let controlador = '/proyecto';

cargarTabla(controlador);

// EDITOR TIPO DOCUMENTO
let descripcion;
DecoupledEditor.create(document.querySelector('[name=descripcion]')).then(editor => {
    const toolbarContainer = document.querySelector('#herramientas');
    toolbarContainer.appendChild(editor.ui.view.toolbar.element);
    descripcion = editor;
}).catch(error => {
    console.error(error);
});

$('.btnGuardar').click(function () {
    let datos = new FormData($('.form')[0]);
    datos.append('descripcion', descripcion.getData());
    guardar(controlador, datos);
    return false;
});

$(".tabla tbody").on("click", ".btnBorrar", function () {
    let id = $(this).attr("codigo");
    let datos = new FormData();
    datos.append("id", id);
    borrar(controlador, datos);
});