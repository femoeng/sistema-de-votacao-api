<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class VotoController extends Controller
{
    public function __construct(){
        $this->middleware('validar_voto',['only'=>['store']]);
    }

 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $votos = \App\Voto::all();
        if (count($votos) > 0) {
          return [
            'vota' => $votos
          ];
        } else {
          abort(404);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $voto_data = $request->voto_data;
        $voto = new \App\Voto($voto_data);
        $voto->save();
        if(isset($request->criterios) && isset($request->projectos)) {

            foreach ($request->criterios as $c) {
                $criterio = App\Criterio::where('id',$c->id)->first();
               //  $projecto = App\Projecto::where('id')->first();
                if(isset($criterio) && isset($projecto)) {
                    $voto->criterios()-save($criterio);
                  //  $voto->projectos()-save($projecto);
                }
            }
            return $voto;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $voto = $request->voto;
        return $voto;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
   
}
