$(function() {
    // Al cambiar el campo se quita mensaje de validacion
    $('input, select').change(function(e){
        removeError('#' + $(this).prop('id'));
    });

    // Validar campos y solicitar creacion de la transaccion
    $('#countryCreate').click(function(e){
        e.preventDefault();
        if (!validatorFields()) {
            $.ajax({
                method: $('form').prop('method'),
                url: $('form').prop('action'),
                url: rootUrl() + '/../../country/store',
                data: $('form').serialize(),
                dataType: 'json',
                beforeSend: function() {
                    inactiveElements();
                },
                success: function (data) {
                    if (data.error !== undefined && data.error != '') {
                        // error en la respuesta
                        showErrors(data.error);
                    } else {
                        alert('Guardado correctamente');
                    }
                },
                complete: function() {
                    activeElements();
                }
            });
        }
    });

    // Validar campos y solicitar creacion de la transaccion
    $('#countryUpdate').click(function(e){
        e.preventDefault();
        if (!validatorFields()) {
            $('#_method').val('PUT');
            $.ajax({
                method: $('form').prop('method'),
                url: rootUrl() + '/../../update/' + $('#id').val(),
                data: $('form').serialize(),
                dataType: 'json',
                beforeSend: function() {
                    inactiveElements();
                },
                success: function (data) {
                    if (data.error !== undefined && data.error != '') {
                        // error en la respuesta
                        showErrors(data.error);
                    } else {
                        alert('Actualizado correctamente');
                    }
                },
                complete: function() {
                    // Activar los campos para la modificacion
                    activeElements();
                }
            });
        }
    });

    // Validar campos y solicitar creacion de la transaccion
    $('#countryDelete').click(function(e){
        e.preventDefault();
        if (confirm('Está seguro?')) {
            $('#_method').val('DELETE');
            $.ajax({
                method: $('form').prop('method'),
                url: rootUrl() + '/../../delete/' + $('#id').val(),
                data: $('form').serialize(),
                dataType: 'json',
                beforeSend: function() {
                    inactiveElements();
                },
                success: function (data) {
                    if (data.error !== undefined && data.error != '') {
                        // error en la respuesta
                        showErrors(data.error);
                    } else {
                        alert('Eliminado correctamente');
                        back();
                    }
                },
                complete: function() {
                    // Activar los campos para la modificacion
                    activeElements();
                }
            });
        }
    });
    /**
     * Valida campos del formulario
     */
    function validatorFields() {
        var error = false;
        var id = $('#id').val();
        var name = $('#name').val();
        $('.help-block').html('');


        if (id == '') {
            error = addError('#id', 'Ingrese el c&oacute;digo');
        }
        if (name == '') {
            error = addError('#name', 'Ingrese el nombre');
        }
        return error;
    }
});