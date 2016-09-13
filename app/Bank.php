<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    /**
     * Datos a aplicar un cast especifico, esto para que funcione correctamente
     * la consulta ajax
     * @var array
     */
    protected $casts = [
        'id' => 'string',
    ];

    /**
     * Consume el WS getBankList
     * @param array $data 
     * @return SimpleXMLElement|string
     */
    public function getBankList($data = array())
    {
        $url = getenv('P2P_URLWS');
        $tag = 'getBankList';
        $tagResponse = 'getBankListResult';
        return callWs($data, $url, $tag, $tagResponse);
    }
}
