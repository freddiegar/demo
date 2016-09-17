<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Bank;

class BankController extends Controller
{
    /**
     * @var App\Bank
     */
    var $Bank;

    /**
     * Crea una nueva instancia del modelo para poderla utilizar en los metodos
     */
    public function __construct()
    {
        $this->Bank = new Bank();
    }
    
    /**
     * Devuelve el listado de bancos disponibles en la tabla banks
     * @return json
     */
    public function get(Request $request)
    {
        return ($request->ajax()) ? json_encode($this->Bank->select('id', 'name')->get()) : abort(404);
    }

    /**
     * Obtiene los bancos disponibles desde el WS habilitado 
     * @return array
     */
    public function getBank()
    {
        $login = getenv('P2P_LOGIN');
        $tranKey = getenv('P2P_TRANKEY');
        $seed = date('c');
        $hashString = sha1( $seed . $tranKey , false);

        $data = array (
            'login' => $login,
            'tranKey' => $hashString,
            'seed' => $seed,
        );
        /*
         | Consume el WS getBankList
        */ 
        $response = $this->Bank->getBankList($data);

        if (is_array($response)) {
            // No existe error, actualiza la tabla banks
            $return['error'] = $this->updateBanks($response);
        } elseif (is_string($response) && !empty($response)) {
            // Error durante el procesamiento de la respuesta
            $return['error'] = $response;
        } else {
            // No se puede determinar el error
            $return['error'] = 'No se pudo obtener la lista de Entidades Financieras, por favor intente m&aacute;s tarde.';
        }

        return $return;
    }

    /**
     * Actualiza la tabla banks con la respuesta del WS getBankList
     * @param SimpleXMLElement $response 
     * @return string
     */
    public function updateBanks($response)
    {
        // Borra los registros de la tabla
        $this->Bank->query()->truncate();

        foreach ($response[0]->item as $key => $value) {
            // Inserta cada nuevo registro
            // Se deben independizar los objetos, se crean nueva instancias
            $Bank = new Bank();
            $Bank->id = $value->bankCode;
            $Bank->name = $value->bankName;
            $Bank->save();
        }
        return '';
    }
}
