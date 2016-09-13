<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Country;

class CountryController extends Controller
{
    /**
     * Devuelve los paises disponibles en la tabla countries
     * @return json
     */
    public function get()
    {
        $Country = new Country;
        return json_encode($Country->select('id', 'name')->get());
    }
}
