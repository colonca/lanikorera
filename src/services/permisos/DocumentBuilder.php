<?php

namespace Src\services\permisos;

class DocumentBuilder
{

    private string $operation;

    public function __construct(string $operation){
       $this->operation = $operation;
    }

    public function build() : ?DocumentManager{
        $manager = null;
        switch ($this->operation) {
            case 'descuento-store' :
                  $manager =  new DocumentDescuentoStore();
                  break;
            case 'descuento-update':
                   $manager = new DocumentDescuentoUpdate();
                   break;
        }
        return $manager;
    }

}
