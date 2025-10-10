<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\MonedaModel;
use App\Clases\General;

class MonedaLogic
{
    public static function Moneda_Desplegable(): RespuestaOperacion
    {
        $lista = MonedaModel::Moneda_Desplegable();
        return new RespuestaOperacion($lista);
    }   

}