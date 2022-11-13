let site_url = $('.site_url').val();

$('#verImagen').hide();
$('[name=imagen]').change(function () {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#verImagen').show();
            $('#verImagen').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    } else $('#verImagen').hide();
});

function limpiarFormulario() {
    $('.text-danger').remove();
    $('.form-control').removeClass('is-invalid');
    $('.alert').removeClass('alert-info alert-warning alert-success alert-error');
    $('.icon').removeClass('fa-info fa-exclamation-triangle fa-check fa-ban');
    $('.alert').hide();
}

function cargarTabla(controlador) {
    $(".tabla").DataTable().destroy();
    $(".tabla").DataTable({
        ajax: {
            method: "POST",
            dataType: 'json',
            cache: false,
            url: site_url + controlador + '/listar',
        },
        "pageLength": 10,
        "responsive": true,
        "autoWidth": true,
        "processing": true,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
}

function guardar(controlador, datos) {
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
                                location.href = site_url + controlador;
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
}

function borrar(controlador, datos) {
    if (confirm('Desea borrar el registro?') == true) {
        $.ajax({
            url: site_url + controlador + '/borrar',
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
                if (respuesta === "ok") {
                    $(".tabla").DataTable().ajax.reload();
                    alert('El registro ha sido borrado correctamente.');
                } else alert('Error al intentar borrar el registro.');
            }
        });
    }
}