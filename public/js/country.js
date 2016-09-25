$(function() {
    // Al cambiar el campo se quita mensaje de validacion
    $('input, select').change(function(e){
        removeError('#' + $(this).prop('id'));
    });

    // Validar campos y solicitar creacion
    $('#countryCreate').click(function(e){
        e.preventDefault();
        if (!validatorFields()) {
            $.ajax({
                method: $('form').prop('method'),
                url: url('/country/store'),
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
                        redirect('/country/index', 'message=Guardado correctamente');
                    }
                },
                complete: function() {
                    activeElements();
                }
            });
        }
    });

    // Validar campos y solicitar actualizacion
    $('#countryUpdate').click(function(e){
        e.preventDefault();
        if (!validatorFields()) {
            setMethod('PUT');
            $.ajax({
                method: $('form').prop('method'),
                url: url('/country/update/' + $('#id').val()),
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
                        redirect('/country/index', 'message=Actualizado correctamente');
                    }
                },
                complete: function() {
                    // Activar los campos para la modificacion
                    activeElements();
                }
            });
        }
    });

    // Eliminacion del pais desde edicion
    $('#countryDelete').click(function(e){
        e.preventDefault();
        countryDelete($('#id').val());
    });

    // Eliminacion del pais desde el index
    $('.countryDelete').click(function(e){
        e.preventDefault();
        countryDelete($(this).attr('id'));
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

    /*/
     * Funcion unica de eliminación
     * @param string id
     */
    function countryDelete(id) {
        if (confirm('Está seguro?')) {
            setMethod('DELETE');
            $.ajax({
                method: $('form').prop('method'),
                url: url('/country/delete/' + id),
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
                        redirect('/country/index', 'message=Eliminado correctamente');
                    }
                },
                complete: function() {
                    // Activar los campos para la modificacion
                    activeElements();
                }
            });
        }
    }
});