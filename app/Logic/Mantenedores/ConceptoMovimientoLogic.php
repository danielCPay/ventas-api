<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\ConceptoMovimientoModel;
use App\Clases\General;

class ConceptoMovimientoLogic
{
    public static function Concepto_Movimiento_Desplegable(): RespuestaOperacion
    {
        $lista = ConceptoMovimientoModel::Concepto_Movimiento_Desplegable();
        return new RespuestaOperacion($lista);
    }   

}