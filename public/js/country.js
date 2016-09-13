$(function() {
    // Cargar lista de paises
    $.ajax({
        method: 'post',
        url: location.href + '/../country',
        data: {
            _token: $('input[name=_token]').val()
        },
        dataType: 'json',
        success: function (data) {
            addOptionsSelect('#country', data);
        }
    });
});