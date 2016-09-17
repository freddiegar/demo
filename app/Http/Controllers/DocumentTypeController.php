<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\DocumentType;

class DocumentTypeController extends Controller
{
    /**
     * Obtiene los tipos de documentos disponibles en la tabla documentTypes
     * @return json
     */
    public function get(Request $request)
    {
        $DocumentType = new DocumentType;
        return ($request->ajax()) ? json_encode($DocumentType->select('id', 'name')->get()) : abort(404);
    }
}
