<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\TransactionRequest;

use App\Transaction;

use App\Person;

class TransactionController extends Controller
{
    /**
     * @var App\Transaction
     */
    protected $Transaction;

    public function __construct()
    {
        $this->Transaction = new Transaction();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = $this->Transaction->paginate();
        return view('transaction.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaction.create');
    }

    /**
     * Consulta el WS createTransaction, si el proceso es exitoso crea el registro
     * en people y transactions
     * @param Request $request 
     * @return array
     */
    public function store(TransactionRequest $request)
    {
        // Datos de acceso al WS
        $login = getenv('P2P_LOGIN');
        $tranKey = getenv('P2P_TRANKEY');
        $seed = date('c'); // ISO::8601
        $hashString = sha1( $seed . $tranKey , false);

        // Valores calculados
        $bankInterface = $request->input('personType');
        $totalAmount = $request->input('amount');
        $taxAmount = ($totalAmount * 16) / 100; // IVA 16%
        $devolutionBase = $totalAmount - $taxAmount;
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        // Valores por omision
        $returnURL = $request->url() . '/../response';
        $reference = escapeXMLCharacters($request->input('reference'));
        $description = 'Referencia pagada: ' . $reference;
        $language = 'ES'; //ISO::631-1
        $currency = 'COP'; // ISO::4217
        $tipAmount = '0';

        $transaction = array (
            'login' => $login,
            'tranKey' => $hashString,
            'seed' => $seed,

            'bankCode' => $request->input('bank'),
            'bankInterface' => $bankInterface,
            'returnURL' => $returnURL,
            'reference' => $reference,
            'description' => $description,
            'language' => $language,
            'currency' => $currency,
            'totalAmount' => $totalAmount,
            'taxAmount' => $taxAmount,
            'devolutionBase' => $devolutionBase,
            'tipAmount' => $tipAmount,
            'ipAddress' => $ipAddress,
            'userAgent' => $userAgent,
        );

        // Datos referentes a la persona que esta realizando la compra
        $payer = array(
            'documentType' => $request->input('documentType'),
            'document' => $request->input('document'),
            'firstName' => escapeXMLCharacters($request->input('firstName')),
            'lastName' => escapeXMLCharacters($request->input('lastName')),
            'company' => escapeXMLCharacters($request->input('company')),
            'emailAddress' => $request->input('emailAddress'),
            'address' => escapeXMLCharacters($request->input('address')),
            'city' => escapeXMLCharacters($request->input('city')),
            'province' => escapeXMLCharacters($request->input('province')),
            'country' => $request->input('country'), // ISO::3166-1,
            'phone' => escapeXMLCharacters($request->input('phone')),
            'mobile' => escapeXMLCharacters($request->input('mobile')),
        );

        $response = $this->Transaction->createTransaction(array_merge($transaction, $payer));

        if (is_array($response)) {
            // Crea la persona asociada con la compra
            $Person = new Person($payer);
            $Person->save();
            // Crea la transaccion
            $this->Transaction->create(
                array(
                    'person' => $Person->id,
                    'personType' => $bankInterface,
                    'transactionID' => $response[0]->transactionID,
                    'trazabilityCode' => $response[0]->trazabilityCode,
                    'sessionID' => $response[0]->sessionID,
                    'returnCode' => $response[0]->returnCode,
                    'responseCode' => $response[0]->responseCode,
                    'responseReasonCode' => $response[0]->responseReasonCode,
                    'responseReasonText' => $response[0]->responseReasonText,
                    // Las trasacciones por defecto quedan en estado pendiente
                    'transactionState' => 'PENDING',
                    'reference' => $reference,
                    'amount' => $totalAmount,
                    'bankURL' => $response[0]->bankURL,
                    'bankCurrency' => $response[0]->bankCurrency,
                    'bankFactor' => $response[0]->bankFactor,
                )
            );
            if (strtoupper($response[0]->returnCode) == 'SUCCESS') {
                // Devuelve URL de la pagina a abrir (esto segun el banco)
                $return['bankURL'] =  $response[0]->bankURL;
                // Devuelve el numero de transaccion para despues poder realiar la consulta
                // Para poder consultar el estado posteriormente
                $return['transactionID'] =  $response[0]->transactionID;
            } else {
                // Error en la consulta
                $return['error'] = $response[0]->responseReasonText;
            }
        } elseif (is_string($response) && !empty($response)) {
            // Error durante el procesamiento de la respuesta
            $return['error'] = $response;
        } else {
            // No se puede determinar el error
            $return['error'] = 'No se pudo conectar con la entidad, intentelo de nuevo m&aacute;s tarde.';
        }

        return $return;
    }

    /**
     * Consulta el estado de una transaccion en particular, basicamente se trata de la compra que se esta 
     * realizando por el usuario
     * @param Request $request 
     * @return array
     */
    public function status(Request $request)
    {
        $login = getenv('P2P_LOGIN');
        $tranKey = getenv('P2P_TRANKEY');
        $seed = date('c');
        $hashString = sha1( $seed . $tranKey , false);
        $transactionID = $request->input('transactionID');

        $data = array (
            'login' => $login,
            'tranKey' => $hashString,
            'seed' => $seed,
            'transactionID' => $transactionID,
        );

        $response = $this->Transaction->getTransactionInformation($data);

        if (is_array($response)) {
            // No existe error
            $return = array(
                'transactionState' => $response[0]->transactionState,
                'responseReasonText' => $response[0]->responseReasonText,
            );
            // Actualiza el estado de la transaccion
            $this->updateTransactionStatus($transactionID, $response[0]->transactionState);
        } elseif (is_string($response) && !empty($response)) {
            // Error durante el procesamiento de la respuesta
            $return['error'] = $response;
        } else {
            // No se puede determinar el error
            $return['error'] = 'No se pudo obtener el estado de la transacci&oacute;n, intentelo de nuevo m&aacute;s tarde.';
        }

        return $return;
    }

    /**
     * Consulta y actuliza el estado de las transacciones PENDING, se utiliza
     * en la tarea programada cuando una trnsaccion no completa el flujo normal
     * Se crea un log de ejecucion
     * @return string
     */
    public function getTransactionStatus()
    {
        $login = getenv('P2P_LOGIN');
        $tranKey = getenv('P2P_TRANKEY');
        $seed = date('c');
        $hashString = sha1( $seed . $tranKey , false);

        Log::info('INICIO Consulta el Estado Transacciones.');

        // Consulta transacciones PENDING
        $TX = $this->Transaction
            ->select('transactionID')
            ->where('transactionState', 'PENDING')
            ->get();
        foreach ($TX as $transactionID) {

            $transactionID = $transactionID['transactionID'];
            $data = array (
                'login' => $login,
                'tranKey' => $hashString,
                'seed' => $seed,
                'transactionID' => $transactionID,
            );

            // Consulta el WS para sabver el estado de la transaccion
            Log::info('Consultando el Estado TX: ' . $transactionID);
            $response = $this->Transaction->getTransactionInformation($data);

            if (is_array($response)) {
                // Actualiza el estado de la transaccion
                Log::info('Actualizando el estado a ' . $response[0]->transactionState);
                $this->updateTransactionStatus($transactionID, $response[0]->transactionState);
            } elseif (is_string($response) && !empty($response)) {
                // Error durante el procesamiento de la respuesta
                Log::info($response);
            } else {
                // No se puede determinar el error
                Log::info('No se pudo obtener el estado de la TX, intentelo de nuevo m&aacute;s tarde.');
            }
        }

        Log::info('TERMINO Consulta el Estado Transacciones.');
        return 'OK';
    }

    /**
     * Actualiza el estado de la transaccion
     * @param string $transactionID 
     * @param string $transactionState 
     * @return bool
     */
    public function updateTransactionStatus($transactionID, $transactionState)
    {
        DB::table('transactions')
            ->where('transactionID', $transactionID)
            ->update(
                array(
                    'transactionState' => $transactionState
                )
            );
        return true;
    }
}
