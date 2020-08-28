<?php

namespace App\Http\Controllers;

use App\Compra;
use App\MFactura;
use App\Serie;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serie = Serie::all();
        return view('configuracion.series.list')->with('series',$serie)->with('location','configuracion');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = 'configuracion';
        return view('configuracion.series.create')->with('location',$location);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'prefijo' => 'required',
            'inicial' => 'required',
            'final' => 'required'
        ]);

        if ($request->final<$request->inicial){
            flash("El numero inicial de la serie debe ser menor que el numero final ")->error();
            return  redirect()->back();
        }
        $series =Serie::where('prefijo',$request->prefijo)->get();
        if ($series->count()>0){
            foreach ($series as $serie){
                if ($request->inicial>=$serie->inicial && $request->inicial<=$serie->final || $request->final>=$serie->inicial && $request->final<=$serie->final){
                    flash("El nombre de la serie ya existe")->error();
                    return  redirect()->back();
                }
            }
        }
        $series = Serie::all();
        foreach ($series as $serie){
            $serie->estado = 'INACTIVO';
            $serie->save();
        }


        $serie =  new Serie();
        $serie->prefijo= $request->prefijo;
        $serie->inicial= $request->inicial;
        $serie->final= $request->final;
        $serie->actual= $request->inicial;
        $serie->estado= 'ACTIVO';
        $result = $serie->save();

        if($result){
            flash("La Serie fue almacenada de forma exitosa!")->success();
            return  redirect()->route('series.index');
        }else{
            flash("La Serie no fue almacenada de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function show(Serie $serie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $serie = Serie::findOrFail($id);
        $location = 'configuracion';
        return view('configuracion.series.edit',compact('serie','location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $serie =  Serie::findOrFail($id);

        if($serie->inicial != $request->inicial  || $serie->final != $request->final){

            $exist = Serie::where([
                ['prefijo',$serie->prefijo],
                ['inicial','<=',$request->inicial],
                ['final','>=',$request->inicial],
                ['id','!=',$serie->id]
            ])->orWhere([
                ['prefijo',$serie->prefijo],
                ['inicial','<=',$request->final],
                ['final','>=',$request->final],
                ['id','!=',$serie->id]
            ])->first();



            if($exist){
                flash('no','warning');
                return redirect()->back();
            }

             if($serie->actual >= $request->inicial || $serie->actual > $request->final ){
                 flash('','warning');
                 return redirect()->back();
             }
        }

        $serie->prefijo = $request->prefijo;
        $serie->inicial = $request->inicial;
        $serie->final = $request->final;

        if ($request->estado == 'ACTIVO'){
            if($serie->actual >= $serie->final){
                flash("La serie no fue actualizada de forma exitosa, ya que el rango de la serie ha sido completado")->success();
                return  redirect()->route('series.index');
            }else{
                $series  = Serie::all();
                foreach ($series as $serie){
                    $serie->estado = 'INACTIVO';
                    $serie->save();
                }
            }
        }
        $serie->estado = $request->estado;
        $result = $serie->save();
        if($result){
            flash("La Serie fue actualizada de forma exitosa!")->success();
            return  redirect()->route('series.index');
        }else{
            flash("La serie no fue actualizada de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serie =Serie::where('id',$id)->first();
        $exist = MFactura::where([
            ['serie',$serie->prefijo],
            ['n_venta','>=',$serie->inicial],
            ['n_venta','<=',$serie->final]
        ])->first();

        if (!$exist) {

            $result = $serie->delete();

            if ($result) {
                flash("La Serie fue eliminada de forma exitosa!")->success();
                return redirect()->route('series.index');
            } else {
                flash("La Serie no fue eliminada de forma exitosa!")->error();
                return redirect()->back();
            }

        }else{
            flash("La Serie no se puede eliminar ya que tiene facturas relacionadas")->error();
            return  redirect()->back();
        }
    }
}
