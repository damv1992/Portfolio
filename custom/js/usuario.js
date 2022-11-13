$('.btnLogin').click(function () {
    let usuario = $('.txtUsuario').val();
    let contraseña = $('.txtContraseña').val();
    let datos = new FormData();
    datos.append('usuario', usuario);
    datos.append('contraseña', contraseña);
    $.ajax({
        url: site_url + '/admin/login',
        method: 'POST',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(json) {
            limpiarFormulario();
            $('.alert').show();
            if (json.contador > 0) {
                $('.alert').addClass('alert-warning');
                $('.icon').addClass('fa-exclamation-triangle');
                $('.titulo').html('Advertencia');
                if ((json.campos) && (json.mensajes)) {
                    var camposs = json.campos.slice(0, -1).split(',');
                    var mensajess = json.mensajes.slice(0, -1).split(',');
                    for (var i = 0; i < camposs.length; i++) {
                        var elemento = $('.'+camposs[i]);
                        $(elemento).addClass('is-invalid')
                        $(elemento).parent().append('<div class="text-danger">'+mensajess[i]+'</div>');
                    }
                }
            } else location.href = site_url + '/admin';
        }
    });
    return false;
});