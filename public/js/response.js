$(function() {
    // Consulta el estado de la transaccion. solo si existe pagina de referencia
    statusTransaction();

    // Cerrar ventana al hacer click en cerrar
    $("#mThanks").on('hidden.bs.modal', function(e){
        closeWindow();
    });
});

/**
 * Cierra y devuelve al formulario inicial
 */
function closeWindow(){
    if (window.opener) {
        window.opener.location.href = location.href + '/../'; 
        window.close();
    } else {
        location.href = location.href + '/../'; 
    }
}

/**
 * Consulta el estado de la transaccion
 * 
 */
function statusTransaction() {
    if (!window.opener) {
        // Muestra ventana modal
        closeWindow();
        return false;
    }
    $.ajax({
        method: 'post',
        url: location.href + '/../getTransactionInfo',
        data: {
            _token: $('input[name=_token]').val(),
            transactionID: window.opener.$('#transactionID').val()
        },
        dataType: 'json',
        success: function (data) {
            if (data.error !== undefined && data.error != '') {
                // Error durante la consulta
                alert(data.error);
            } else {
                // Estable respuesta
                $('#transactionState').html(data.transactionState[0]);
                $('#responseReasonText').html(data.responseReasonText[0]);
                // Muestra ventana modal
                $('#mThanks').modal('show');
            }
        }, 
        error: function (data) {
            console.log('Error obteniendo el estado de la transaccion');
        }
    });
}