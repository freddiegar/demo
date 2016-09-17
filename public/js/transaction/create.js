$(function() {
    // Al cambiar el campo se quita mensaje de validacion
    $('input, select').change(function(e){
        removeError('#' + $(this).prop('id'));
    });

    // Cerrar ventana al hacer click en cerrar
    $("#mAgradecimiento").on('hidden.bs.modal', function(e){
        closeWindow();
    });

    // Validar campos del formulario al realizar el pago
    $('#pse').click(function(e){
        e.preventDefault();
        if (!validatorFields()) {
            $('#mBank').modal('show');
        }
    });

    // Validar campos y solicitar creacion de la transaccion
    $('#transactionCreate').click(function(e){
        e.preventDefault();
        if (!validatorBanks()) {
            // Asigna valores para enviar en formulario
            $('#personType').val($('#bankInterface').val());
            $('#bank').val($('#bankCode').val());
            $.ajax({
                method: $('form').prop('method'),
                url: rootUrl() + '/../../transaction/store',
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
                        // Asigna numeor de trasaccion para realizar consulta de estado posteriormente
                        $('#transactionID').val(data.transactionID[0]);
                        if (!$.isEmptyObject(data.bankURL)) {
                            // Abre ventana modal con interface de PSE
                            var h = $(window).height() - (($(window).height() * 20) / 100);
                            var w = $(window).width() - (($(window).width() * 20) / 100);
                            window.open(data.bankURL[0], 'response', "height=" + h + ",width=" + w + ",status=yes,toolbar=no,menubar=no,location=yes,scrollbars=yes,resizable=yes");
                        } else {
                            alert('No se pudo establecer conexión con el banco, intentelo nuevamente');
                        }
                    }
                },
                complete: function() {
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
        var documentType = $('#documentType').val();
        var vdocument = $('#document').val();
        var emailAddress = $('#emailAddress').val();
        var country = $('#country').val();
        var reference = $('#reference').val();
        var amount = $('#amount').val();

        var emailFormat = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var numericFormat = /^\d+$/;
        $('.help-block').html('');


        if (documentType == '') {
            error = addError('#documentType', 'Seleccione el tipo de documento');
        }
        if (vdocument == '') {
            error = addError('#document', 'Ingrese su numero de documento');
        } else if (!numericFormat.test(vdocument)) {
            error = addError('#document', 'El documento solo permite n&uacute;meros');
        }
        if (emailAddress == '') {
            error = addError('#emailAddress', 'Ingrese su correo electr&oacute;nico');
        } else if (!emailFormat.test(emailAddress)) {
            error = addError('#emailAddress', 'Correo electr&oacute;nico no v&aacute;lido');
        }
        if (country == '') {
            error = addError('#country', 'Seleccione el pa&iacute;s');
        }
        if (reference == '') {
            error = addError('#reference', 'Ingrese el n&uacute;mero de factura a pagar');
        }
        if (amount == '') {
            error = addError('#amount', 'Ingrese el valor de la factura a pagar');
        } else if (!numericFormat.test(amount)) {
            error = addError('#amount', 'El valor de la factura solo permite n&uacute;meros');
        }

        return error;
    }

    /**
     * Validador formulario bancos
     */
    function validatorBanks() {
        var error = false;
        var personType = $('#bankInterface').val();
        var bank = $('#bankCode').val();
        $('.help-block').html('');

        if (personType == '') {
            error = addError('#bankInterface', 'Seleccione el tipo de banca');
        }
        if (bank == '') {
            error = addError('#bankCode', 'Seleccione el banco');
        }

        return error;
    }
});