$(function() {
    // Cargar lista de tipos de banca
    $.ajax({
        method: 'post',
        url: location.href + '/../personType',
        data: {
            _token: $('input[name=_token]').val()
        },
        dataType: 'json',
        success: function (data) {
            addOptionsSelect('#bankInterface', data);
        }
    });
});