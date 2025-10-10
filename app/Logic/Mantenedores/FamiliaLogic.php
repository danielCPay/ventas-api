<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\FamiliaModel;
use App\Clases\General;

class FamiliaLogic
{
    public static function Familia_Desplegable(): RespuestaOperacion
    {
        $lista = FamiliaModel::Familia_Desplegable();
        return new RespuestaOperacion($lista);
    }   

}