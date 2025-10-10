<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\PerfilUsuarioModel;
use App\Clases\General;

class PerfilUsuarioLogic
{
    public static function Perfil_Desplegable(): RespuestaOperacion
    {
        $lista = PerfilUsuarioModel::Perfil_Desplegable();
        return new RespuestaOperacion($lista);
    }   

}