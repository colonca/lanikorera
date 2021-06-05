<?php

namespace Src\services\permisos;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\DescuentoStore;

class DocumentDescuentoStore implements DocumentManager
{

    public function generar($request,$code): void
    {
        $pdf = PDF::loadView('pdfs.descuentoStore',['request' => $request, 'code' => $code])
                  ->setPaper('a4', 'landscape')
                  ->output();
        Mail::to(env('MAIL_FROM_ADMIN','ing.beto.rojas@gmail.com'))->send(new DescuentoStore($pdf));
    }
}
