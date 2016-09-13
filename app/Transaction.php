<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * Campos que se pueden diligenciar, esto para evitar errores massException
     * @var array
     */
    protected $fillable = array(
        'person',
        'personType',
        'transactionID',
        'transactionState',
        'trazabilityCode',
        'sessionID',
        'returnCode',
        'responseCode',
        'responseReasonCode',
        'responseReasonText',
        'reference',
        'amount',
        'bankURL',
        'bankCurrency',
        'bankFactor',
    );

    /**
     * Realiza el consumo del WS createTransaction
     * @param array $data 
     * @return SimpleXMLElement
     */
    public function createTransaction($data = array())
    {
        $url = getenv('P2P_URLWS');
        $tag = 'createTransaction';
        $tagResponse = 'createTransactionResult';
        return callWs($data, $url, $tag, $tagResponse);
    }

    /**
     * Realiza el consumo del WS getTransactionInformation
     * @param array $data 
     * @return SimpleXMLElement
     */
    public function getTransactionInformation($data = array())
    {
        $url = getenv('P2P_URLWS');
        $tag = 'getTransactionInformation';
        $tagResponse = 'getTransactionInformationResult';
        return callWs($data, $url, $tag, $tagResponse);
    }
}
