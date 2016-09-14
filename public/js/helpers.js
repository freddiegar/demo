/**
 * Agrega elementos a una lista desplegable
 * @param select Selector de la lista, se puden usar clases(.), nombre, id(#), etc
 * @param data Lista de valores tipo json a agregar a la lista
 * return void
 */
function addOptionsSelect(select, data) {
    for (var i = 0; i < data.length; i++) {
        $(select).append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
    }
}

/**
 * Agrega la descripcion del error a los elementos
 * @param select Selector de la lista, se puden usar clases, nombre, id, etc
 * @param error Drescripcion del error
 * return bool|true
 */
function addError(select, error) {
    $(select).next('.help-block').empty().html(error);
    return true;
}

/**
 * Quita la descripcion del error a los elementos
 * @param select Selector de la lista, se puden usar clases, nombre, id, etc
 * return void
 */
function removeError(select) {
    $(select).next('.help-block').html('');
}

/**
 * Asigna los errores a cada uno de los campos
 * @param json Errores
 * return void
 */
function assignErrors(error) {
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