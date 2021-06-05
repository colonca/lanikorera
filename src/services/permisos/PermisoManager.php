<?php

namespace Src\services\permisos;

use App\Permisos;
use Illuminate\Support\Facades\Auth;
use Src\services\permisos\DocumentBuilder;

class PermisoManager {

    public function generar($request) {
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
        $permiso->code = bcrypt($code);
        $permiso->state = 'PENDIENTE';
        $permiso->time = $moment;
        $permiso->document = $document;
        $permiso->save();
        $operation = $permiso->operation;
        $this->generarDocument($operation, $request,$code);
    }

    public function generarDocument(string $operation,$request,$code){
        $builder = new DocumentBuilder($operation);
        $manager = $builder->build();
        $manager->generar($request,$code);
    }

}