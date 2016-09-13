$(function() {
    // Cargar lista de bancos
    $.ajax({
        method: 'post',
        url: location.href + '/../bank',
        data: {
            _token: $('input[name=_token]').val()
        },
        dataType: 'json',
        success: function (data) {
            addOptionsSelect('#bankCode', data);
        }, 
        error: function (data) {
            alert('No se pudo obtener la lista de Entidades Financieras, por favor intente más tarde');
        }
    });
});