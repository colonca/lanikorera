<?php

namespace Src\services\permisos;

interface DocumentManager
{

    public function generar($request, $code) : void;

}
