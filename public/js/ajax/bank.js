$(function() {
    // Cargar lista de bancos
    $.ajax({
        method: 'post',
        url: rootUrl() + '/../../bank/get',
        data: {
            _token: $('input[name=_token]').val()
        },
        dataType: 'json',
        success: function (data) {
            addOptionSelect('#bankCode', data);
        }, 
        error: function (data) {
            console.log('No se cargaron los bancos');
            alert('No se pudo obtener la lista de Entidades Financieras, por favor intente más tarde');
        }
    });
});