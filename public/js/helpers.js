$(function() {
    // Establece el ultimo mensaje enviado por el sistema
    if (location.search.indexOf('message') !== -1) {
        setMessage('success', location.search, location.search.indexOf('message') + 8);
    }
    // Establece el ultimo error enviado por el sistema
    if (location.search.indexOf('error') !== -1) {
        setMessage('danger', location.search, location.search.indexOf('error') + 6);
    }
    // Accion del boton regresar
    $('.btn-back').click(function(e){
        //  Devuelve a la pagina llamada anteriormente
        back();
    })
    /*
    console.log('referrer: ' + document.referrer); 
    console.log('origin: ' + window.location.origin); 
    // http://localhost:81
    console.log('href: ' + window.location.href);
    // http://localhost:81/place2pay/public/country/index?message=Guardado%20correctamente
    console.log('protocol: ' + window.location.protocol);
    // http:
    console.log('host: ' + window.location.host);
    // localhost:81
    console.log('hostname: ' + window.location.hostname);
    // localhost
    console.log('port: ' + window.location.port);
    // 81
    console.log('pathname: ' + window.location.pathname);
    // /place2pay/public/country/index
    console.log('search: ' + window.location.search);
    // ?message=Guardado%20correctamente
    */
})

// Determina si se enfoco el primer elemento con error
focusAsigned = false;

/**
 * Agrega elementos a una lista desplegable
 * @param select Selector de la lista, se puden usar clases(.), nombre, id(#), etc
 * @param data Lista de valores tipo json a agregar a la lista
 * return void
 */
function addOptionSelect(select, data) {
    if (select.length > 0) {
        for (var i = 0; i < data.length; i++) {
            $(select).append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
        }
    }
}

/**
 * Agrega la descripcion del error a los elementos
 * @param select Selector de la lista, se puden usar clases, nombre, id, etc
 * @param error Drescripcion del error
 * return bool|true
 */
function addError(select, error) {
    $(select).parent().addClass('has-error');
    $(select).next('.help-block').empty().html(error);
    if (focusAsigned === false) {
        $(select).focus();
        focusAsigned = true;
    }
    return true;
}

/**
 * Quita la descripcion del error a los elementos
 * @param select Selector de la lista, se puden usar clases, nombre, id, etc
 * return void
 */
function removeError(select) {
    $(select).parent().removeClass('has-error');
    $(select).next('.help-block').empty();
    focusAsigned = false;
}

/**
 * Asigna los errores a cada uno de los campos
 * @param json Errores
 * return void
 */
function showErrors(error) {
    if (!$.isEmptyObject(error)) {
        // JSON
        for (var key in error) {
            if ($('#'+key).length) {
                // El elemento existe
                addError('#'+key, error[key]);
            } else {
                // El elemento no existe
                ($.type(error[key]) === "string") ? setMessage('danger', error, 0) : setMessage('danger', error[key], 0);
                return false;
            }
        }
    } else {
        // string
        setMessage('danger', error, 0);
    }
}

/**
 * Inactiva los elementos del formulario, normalmente se usa durante los submits
 * return void
 */
function inactiveElements() {
    $('input, select, button').addClass('disabled').prop('disabled', true);
}

/**
 * Activa los elementos del formulario, normalmente se usa durante los submits
 * return void
 */
function activeElements() {
    $('input, select, button').removeClass('disabled').prop('disabled', false);
}

/**
 * Retorna a la pagina anterior
 */
function back() {
    var oldUrl = document.referrer;
    var newUrl = oldUrl;
    if (oldUrl.indexOf('message') !== -1) {
        posMessage = oldUrl.indexOf('message');
        newUrl = oldUrl.substring(0, posMessage);
    } else if (oldUrl.indexOf('message') !== -1) {
        posMessage = oldUrl.indexOf('message');
        newUrl = oldUrl.substring(0, posMessage);
    }

    if (document.referrer !== newUrl) {
        location.href = newUrl;
    } else {
        history.back();
    }
}

/**
 * Devuelve la URL actual
 */
function url(url) {
    // Si no se pasa el argumento
    url = (url === undefined) ? '' : url;
    return $('#baseUrl').val() + url;
}

/**
 * Establece la URL actual
 * @param uri
 */
function redirect(uri, get) {
    url = url();
    get = (get === undefined) ? '' : get;
    var search = '';
    if (document.referrer.indexOf('page') !== -1) {
        // Extrae el parametro de pagina para no perder la paginacion
        posPage = document.referrer.indexOf('page');
        posAmpersand = document.referrer.substring(posPage).indexOf('&');
        search = (posAmpersand === -1)
            // no tiene mas parametros ademas del page
            ? '?' + document.referrer.substring(posPage) 
            // tiene mas parametros ademas del page, por ejemplo: message, entonces lo quita
            : '?' + document.referrer.substring(posPage, posPage + posAmpersand);
    }
    if ($.trim(get) !== '') {
        // Agrega otros parametros adicionales
        if (search === '') {
            // No hay pagina
            search = '?';
        } else {
            // Hay pagina, lo concatena
            get = '&' + get;
        }

    }
    window.location.assign(url + uri + search + get);
}

/**
 * Establece mensajes de error
 * @param classs
 * @param text
 * @param posicion
 * @return void
 */
function setMessage(classs, text, posicion) {
    $('#message').addClass('alert-' + classs).removeClass('hidden').children('#alert').html(decodeURI(text.substring(posicion)));
}

/**
 * Establece el method de envio
 * @param method
 * @return void
 */
function setMethod(method) {
    $('input[name=_method]').val(method);
}