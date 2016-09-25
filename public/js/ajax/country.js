$(function() {
    // Cargar lista de bancos
    $.ajax({
        method: 'post',
        url: url('/country/get'),
        data: {
            _token: $('input[name=_token]').val()
        },
        dataType: 'json',
        success: function (data) {
            addOptionSelect('#country', data);
        }, 
        error: function (data) {
            console.log('No se cargaron los paises');
        }
    });
});