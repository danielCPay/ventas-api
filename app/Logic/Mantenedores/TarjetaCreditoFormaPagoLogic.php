<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\TarjetaCreditoFormaPagoModel;
use App\Clases\General;

class TarjetaCreditoFormaPagoLogic
{
    public static function TarjetaCredito_FormaPago_Desplegable($formapagoid): RespuestaOperacion
    {
        $lista = TarjetaCreditoFormaPagoModel::TarjetaCredito_FormaPago_Desplegable($formapagoid);
        return new RespuestaOperacion($lista);
    }
}