$(function() {
    // Cargar lista de tipos de banca
    $.ajax({
        method: 'post',
        url: rootUrl() + '/../../personType/get',
        data: {
            _token: $('input[name=_token]').val()
        },
        dataType: 'json',
        success: function (data) {
            addOptionSelect('#bankInterface', data);
        },
        error: function (data) {
            console.log('No se cargaron los tipos de banca');
        }
    });
});