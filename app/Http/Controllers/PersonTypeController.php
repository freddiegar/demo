<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\PersonType;

class PersonTypeController extends Controller
{
    /**
     * Obtiene los tipos de banca disponibles en la tabla personTypes
     * @return json
     */
    public function get(Request $request)
    {
        $PersonType = new PersonType();
        return ($request->ajax()) ? json_encode($PersonType->select('id', 'name')->get()) : abort(404);
    }
}
