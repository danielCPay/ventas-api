<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\UsuarioLogic;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function __construct()
    {
    }

    public function Login(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->input();            
            $usuario = $datos['usuario'];  
            $contrasena = $datos['contrasena'];                 
            
            $res = UsuarioLogic::Login($usuario , $contrasena);
        } catch (\Exception $e) {
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }


}