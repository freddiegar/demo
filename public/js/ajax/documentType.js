$(function() {
    // Cargar lista de tipos documento
    $.ajax({
        method: 'post',
        url: url('/documentTypes/get'),
        data: {
            _token: $('input[name=_token]').val()
        },
        dataType: 'json',
        success: function (data) {
            addOptionSelect('#documentType', data);
        },
        error: function (data) {
            console.log('No se cargaron los tipos de documento');
        }
    });
});