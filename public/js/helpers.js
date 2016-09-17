$(function() {
    // Accion del boton regresar
    $('.btn-back').click(function(e){
        //  Devuelve a la pagina llamada anteriormente
        back();
    })
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
                ($.type(error[key]) === "string") ? alert(error) : alert(error[key]);
                return false;
            }
        }
    } else {
        // string
        alert(error);
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
    location.href = document.referrer;
}

/**
 * Devuelve la URL actual
 */
function rootUrl() {
    return window.location.href;
}