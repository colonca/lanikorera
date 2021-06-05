<?php

namespace App\Http\Controllers;

use App\Permisos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Src\services\permisos\DocumentBuilder;


class PermisosController extends Controller
{
    public function index(){
        $permisos = Permisos::all();
        $location = 'reportes';
        return view('reportes.permisos.list',compact('permisos','location'));
    }

    public function generar(Request $request) {
        $this->validate($request,[
            'location' => 'required',
            'route' => 'required'
        ]);
        $location = $request->location;
        $moment = date('y-m-d h:i:s');
        $document = 'public/documents/'.$request->operation.'-'.date('Y-m-d-h-i-s',strtotime($moment));
        $permiso = new Permisos();
        $user = Auth::user();
        $permiso->identification = $user->identificacion;
        $permiso->name = $user->nombres;
        $permiso->operation = $request->operation;
        $code = '';
        for($i = 0; $i < 5; $i++){
           $code.=rand(0,9);
        }
        $permiso->code = $code;
        $permiso->state = 'PENDIENTE';
        $permiso->time = $moment;
        $permiso->document = $document;
        $permiso->save();
        $operation = $permiso->operation;
        $result = Storage::put($document,json_encode($request->all()));
        $this->generarDocument($operation, $request->all());
        if(!$result)
            return redirect()->back();
        return view('reportes.permisos.permissions',compact('location','permiso'));
    }


    public function cancelar(){
        $permisoso = Permisos::all();
        foreach ($permisoso as $permiso){
            $state = $permiso->state;
            if($state === 'PENDIENTE'){
                $moment = date('y-m-d h:i:s');
                $time = round((strtotime($moment) - strtotime($permiso->time))/60);
                if($time > 15){
                    $permiso->state = 'CANCELADO';
                    $permiso->save();
                }
            }
        }
    }

    public function verificar(){

    }

    public function generarDocument(string $operation,$request){
        $builder = new DocumentBuilder($operation);
        $manager = $builder->build();
        $manager->generar($request);
    }

}
