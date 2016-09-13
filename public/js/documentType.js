$(function() {
    // Cargar lista de tipos documento
    $.ajax({
        method: 'post',
        url: location.href + '/../documentTypes',
        data: {
            _token: $('input[name=_token]').val()
        },
        dataType: 'json',
        success: function (data) {
            addOptionsSelect('#documentType', data);
        }
    });
});