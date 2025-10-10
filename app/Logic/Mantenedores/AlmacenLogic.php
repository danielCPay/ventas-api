<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\AlmacenModel;
use App\Clases\General;

class AlmacenLogic
{
    public static function Almacen_Desplegable(): RespuestaOperacion
    {
        $lista = AlmacenModel::Almacen_Desplegable();
        return new RespuestaOperacion($lista);
    }   

}