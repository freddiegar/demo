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
    public function get()
    {
        $PersonType = new PersonType();
        return json_encode($PersonType->select('id', 'name')->get());
    }
}
