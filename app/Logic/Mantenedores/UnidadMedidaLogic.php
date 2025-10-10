<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\UnidadMedidaModel;
use App\Clases\General;

class UnidadMedidaLogic
{
    public static function Unidad_Medida_Desplegable(): RespuestaOperacion
    {
        $lista = UnidadMedidaModel::Unidad_Medida_Desplegable();
        return new RespuestaOperacion($lista);
    }   

}