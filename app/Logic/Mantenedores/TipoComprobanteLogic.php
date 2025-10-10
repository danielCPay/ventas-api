<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\TipoComprobanteModel;
use App\Clases\General;

class TipoComprobanteLogic
{
    public static function TipoComprobante_Desplegable($proceso): RespuestaOperacion
    {
        $lista = TipoComprobanteModel::TipoComprobante_Desplegable($proceso);
        return new RespuestaOperacion($lista);
    }   

}