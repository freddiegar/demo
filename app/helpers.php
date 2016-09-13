<?php 

use Illuminate\Support\Facades\Log;

/**
 * Construye el mensaje XML a enviar con base en los campos pasados como parametros
 * y las plantillas en resources/xml
 * @param array $data Datos a reemplazar en la plantilla
 * @param string $template Nombre de la plantilla a utilizar
 * @return string
 */
function getXmlMessage($data, $template) {

    if ($template == '') {
        return 'Por favor defina la plantilla XML a utilizar.';
    }

    // Cargar plantilla del XML a usar como mensaje
    $xml = file_get_contents(realpath(__DIR__) . '/../resources/xml/' . $template . '.xml');

    // Reemplazar la etiqueta con el valor correspondiente
    foreach ($data as $key => $value) {
        $xml = str_ireplace('{{' . $key . '}}', $value, $xml);
    }

    // Eliminar etiquetas no utilizadas
    $xml = preg_replace('#\{\{([A-z0-9\s\._])*\}\}#', '', $xml);

    return $xml;
}

/**
 * Realiza el consumo el WS por curl devolviendo la respuesta en un objeto SimpleXMLElement
 * @param array $data Datos a reemplzar en la plantilla
 * @param string $url Wsdl del WS
 * @param string $tag Nombre de la plantilla utilizar
 * @param string $tagResponse Ubicacion dentro del XML de respuesta donde estan los datos a cosumir
 * @param int $timeout Tiempo máximo de espera para el consumo de WS
 * @return SimpleXMLElement|string
 */
function callWs($data, $url = '', $tag = '', $tagResponse = '', $timeout = 120) 
{
    // Carga el mensaje que va a enviar al WS
    $xml = getXmlMessage($data, $tag);

    if(!function_exists('curl_init')) {
        Log::error('Libreria cURL no encontrada, por favor habilitarla');
        return 'Error en el WS';
    }

    $ch = curl_init(); // Inicializa apuntador al objeto Curl
    curl_setopt($ch, CURLOPT_URL, $url); // Asigna URL
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// permite redireccionamientos
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // determina retorno por variable
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Deshabilita verificacion de certificado SSL
    // curl_setopt($ch, CURLOPT_PORT, 8443);


    $Headers = array(0 => "Content-Type: text/xml");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $Headers);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout); // Determina Timeout
    curl_setopt($ch, CURLOPT_POST, 1); // Asigna Metodo POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml); // Empaca mensaje dentro de protocolo POST

    $result = curl_exec($ch); // Ejecuta el llamado

    // Si se produce un error lo procesa y genera respuesta en formato SOAP-Fault.
    // --------------------------------------------------------------------------
    curl_close($ch);

    if($result === false){
        Log::error('Error consultando el WS');
        return 'Error en el WS';
    }

    return responseWs($tagResponse, $result);
}

/**
 * Procesa la respuesta entregada por el WS
 * @param string $tag Dentro del cual se encutra la respuesta
 * @param string $data XML devuelto por el WS
 * @return SimpleXMLElement
 */
function responseWs($tag, $data = '')
{
    $xml = new \SimpleXMLElement($data);
    // Busca error en la respuesta
    $xml->registerXPathNamespace('s', 'http://schemas.xmlsoap.org/soap/envelope/');
    $error = $xml->xpath('/s:Envelope/s:Body/s:Fault');
    if(!empty($error)) {
        // Existe error en la respuesta
        $faultcode = $error[0]->faultcode;
        $faultstring = $error[0]->faultstring;
        $textError = '[' . $faultcode . '] ' . $faultstring;
        Log::error('Detalle error: ' . $textError);
        return $textError;
    }

    // Genera respuesta correcta
    $response = $xml->xpath('/s:Envelope/s:Body//' . $tag);
    if (empty($response)) {
        $textError = 'No se encontro el Path ' . $tag;
        Log::error('Detalle error: ' . $textError);
        return $textError;
    }

    return $response;
}

/**
 * Escapar caracteres XML a enviar en mensaje
 * @param string $data 
 * @return string
 */
function escapeXMLCharacters($data)
{
    return str_replace(['&', '<', '>'], ['&amp;', '&lt:', '&gt;'], $data);
}