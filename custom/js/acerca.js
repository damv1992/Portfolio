$('.acerca').removeClass('btn-secondary');
$('.acerca').addClass('btn-primary');
let controlador = '/acerca';
let freelance = 0;

/* EDITOR TIPO DOCUMENTO */
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
    if ($('.freelance').prop('checked')) freelance = 1;
    datos.append('freelance', freelance);
    datos.append('descripcion', descripcion.getData());
    datos.set('imagen', $("[name=imagen]").prop('files')[0]);
    guardar(controlador, datos);
    return false;
});