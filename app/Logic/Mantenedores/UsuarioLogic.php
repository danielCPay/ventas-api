<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\UsuarioModel;
use App\Clases\General;

class UsuarioLogic
{
    public static function Login(String $usuario,String $contrasena): RespuestaOperacion
    {
        $resultado = UsuarioModel::Login($usuario, $contrasena);
        if(General::isEmpty($resultado)){$resultado=NULL;}
        return new RespuestaOperacion($resultado);
    }

}