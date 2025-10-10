<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\FormaPagoModel;
use App\Clases\General;

class FormaPagoLogic
{
    public static function Forma_Pago_Desplegable(): RespuestaOperacion
    {
        $lista = FormaPagoModel::Forma_Pago_Desplegable();
        return new RespuestaOperacion($lista);
    }   

}