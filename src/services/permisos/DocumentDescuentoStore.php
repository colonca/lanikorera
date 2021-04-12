<?php

namespace Src\services\permisos;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;

class DocumentDescuentoStore implements DocumentManager
{

    public function generar($request): void
    {
        $pdf = PDF::loadView('pdfs.descuentoStore',['request' => $request])
                  ->setPaper('a4', 'landscape')
                  ->output();
        Mail::to('ing.beto.rojas@gmail.com')->send(new \App\Mail\DescuentoStore($pdf));
    }
}
