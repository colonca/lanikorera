<?php

namespace App\Http\Controllers;

use App\Auditoriausuario;
use App\Http\Requests\PaginaRequest;
use App\Pagina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaginaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginas = Pagina::all()->sortBy('nombre');
        return view('usuarios.paginas.list')
            ->with('location', 'usuarios')
            ->with('paginas', $paginas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.paginas.create')
            ->with('location', 'usuarios');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaginaRequest $request)
    {
        $pagina = new Pagina($request->all());
        foreach ($pagina->attributesToArray() as $key => $value) {
            $pagina->$key = strtoupper($value);
        }
        if (mb_stristr($pagina->nombre, "PAG_") === false) {
            flash("El nombre de la página <strong>" . $pagina->nombre . "</strong> es incorrecto, recuerde que debe tener la estructura PAG_ seguido del nombre que ud desee.")->warning();
            return redirect()->route('pagina.create');
        }
        $u = Auth::user();
        $result = $pagina->save();
        if ($result) {
            $aud = new Auditoriausuario();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE PAGINA. DATOS: ";
            foreach ($pagina->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La Página <strong>" . $pagina->nombre . "</strong> fue almacenada de forma exitosa!")->success();
            return redirect()->route('pagina.index');
        } else {
            flash("La Página <strong>" . $pagina->nombre . "</strong> no pudo ser almacenada. Error: " . $result)->error();
            return redirect()->route('pagina.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pagina  $pagina
     * @return \Illuminate\Http\Response
     */
    public function show(Pagina $pagina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pagina  $pagina
     * @return \Illuminate\Http\Response
     */
    public function edit(Pagina $pagina)
    {
        return view('usuarios.paginas..edit')
            ->with('location', 'usuarios')
            ->with('pagina', $pagina);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pagina  $pagina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagina $pagina)
    {
        $m = new Pagina($pagina->attributesToArray());
        foreach ($pagina->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $pagina->$key = strtoupper($request->$key);
            }
        }
        if (mb_stristr($pagina->nombre, "PAG_") === false) {
            flash("El nombre de la página <strong>" . $pagina->nombre . "</strong> es incorrecto, recuerde que debe tener la estructura PAG_ seguido del nombre que ud desee.")->warning();
            return redirect()->route('pagina.edit', $pagina->id);
        }
        $u = Auth::user();
        $result = $pagina->save();
        if ($result) {
            $aud = new Auditoriausuario();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICION DE PAGINA. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($m->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($pagina->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("La Página <strong>" . $pagina->nombre . "</strong> fue modificada de forma exitosa!")->success();
            return redirect()->route('pagina.index');
        } else {
            flash("La Página <strong>" . $pagina->nombre . "</strong> no pudo ser modificada. Error: " . $result)->error();
            return redirect()->route('pagina.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pagina  $pagina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagina $pagina)
    {
        //
    }
}
