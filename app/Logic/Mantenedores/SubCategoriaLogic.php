<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\SubCategoriaModel;
use App\Clases\General;

class SubCategoriaLogic
{
    public static function SubCategoria_Desplegable(): RespuestaOperacion
    {
        $lista = SubCategoriaModel::SubCategoria_Desplegable();
        return new RespuestaOperacion($lista);
    }   

}