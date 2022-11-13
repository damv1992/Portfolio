$('.proyecto').removeClass('btn-secondary');
$('.proyecto').addClass('btn-primary');
let controlador = '/captura';
$('#verImagen').show();

cargarTabla(controlador);

$('.btnGuardar').click(function () {
    let datos = new FormData($('.form')[0]);
    datos.set('imagen', $("[name=imagen]").prop('files')[0]);
    $.ajax({
        url: site_url + controlador + '/validar',
        method: 'POST',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (json) {
            limpiarFormulario();
            $('.alert').show();
            let mensaje;
            if (json.contador > 0) {
                mensaje = 'Por favor revise los datos marcados.';
                $('.alert').addClass('alert-warning');
                $('.icon').addClass('fa-exclamation-triangle');
                $('.titulo').html('Advertencia');
                $('.mensaje').html('<p class="text-danger">' + mensaje + '</p>');
                if ((json.campos) && (json.mensajes)) {
                    var camposs = json.campos.slice(0, -1).split(',');
                    var mensajess = json.mensajes.slice(0, -1).split(',');
                    for (var i = 0; i < camposs.length; i++) {
                        var elemento = $('[name=' + camposs[i] + ']');
                        $(elemento).addClass('is-invalid')
                        $(elemento).parent().append('<div class="text-danger">' + mensajess[i] + '</div>');
                    }
                }
            } else {
                $.ajax({
                    url: site_url + controlador + '/guardar',
                    method: 'post',
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (respuesta) {
                        if (respuesta === 'success') {
                            mensaje = 'Datos guardados correctamente. Redireccionando...';
                            $('.mensaje').html('<p class="text-' + respuesta + '">' + mensaje + '</p>');
                            setTimeout(function () {
                                location.href = site_url + '/proyecto/capturas/' + $('[name=proyecto]').val();
                            }, 3000);
                        } else {
                            mensaje = 'Algo falló al guardar los datos';
                            $('.mensaje').html('<p class="text-danger">' + mensaje + '</p>');
                        }
                    }
                });
            }
        }
    });
    return false;
});

$(".tabla tbody").on("click", ".btnBorrar", function () {
    let id = $(this).attr("codigo");
    let datos = new FormData();
    datos.append("id", id);
    borrar(controlador, datos);
});