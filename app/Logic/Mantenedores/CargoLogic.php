<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\CargoModel;
use App\Clases\General;

class CargoLogic
{
    public static function Cargo_Desplegable(): RespuestaOperacion
    {
        $lista = CargoModel::Cargo_Desplegable();
        return new RespuestaOperacion($lista);
    }   

}