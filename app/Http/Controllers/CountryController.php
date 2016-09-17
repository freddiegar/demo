<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CountryRequest;

use App\Country;

class CountryController extends Controller
{

    protected $Country;

    public function __construct()
    {
        $this->Country = new Country;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = $this->Country->paginate(2);
        // echo '<pre>', print_r($rows, 1), '</pre>';die;
        return view('country/index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('country/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $this->Country->id = strtoupper($request->input('id'));
        $this->Country->name = $request->input('name');
        $this->Country->save();

        return json_encode(array());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = $this->Country->find($id);
        return view('country.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, $id)
    {
        $this->Country
            ->where('id', $id)
            ->update([
                'name' => $request->input('name'),
            ]);
        
        return json_encode(array());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->Country
            ->where('id', $id)
            ->delete();
        
        return json_encode(array());
    }

    /**
     * Devuelve los paises disponibles en la tabla countries
     * @return json
     */
    public function get(Request $request)
    {
        return ($request->ajax()) ? json_encode($this->Country->select('id', 'name')->get()) : abort(404);
    }
}
