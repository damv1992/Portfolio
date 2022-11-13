$('.btnEnviarWhatsApp').click(function () {
    let datos = new FormData($('.formContacto')[0]);
    let url = site_url + '/home/enviarWhatsApp';
    enviar(datos, url);
    return false;
});

$('.btnEnviarCorreo').click(function () {
    let datos = new FormData($('.formContacto')[0]);
    let url = site_url + '/home/enviarCorreo';
    enviar(datos, url);
    return false;
});

function enviar(datos, url) {
    $.ajax({
        url: url,
        method: 'POST',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            if (respuesta === 'ok') {
                alert('Enviado.');
                $('.formContacto').reset();
            } else if (respuesta === 'error') alert('Algo falló al enviar.');
            else if (respuesta === 'nombre') alert('Dato nombre es obligatorio.');
            else if (respuesta === 'correo') alert('Dato correo es obligatorio.');
            else if (respuesta === 'asunto') alert('Dato asunto es obligatorio.');
            else if (respuesta === 'mensaje') alert('Dato mensaje es obligatorio.');
            else window.location.href = respuesta;
        }
    });
}