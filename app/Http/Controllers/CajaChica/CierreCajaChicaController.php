<?php

namespace App\Http\Controllers\CajaChica;


use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Clases\General;
use App\Logic\CajaChica\CierreCajaChicaLogic;
use Illuminate\Http\Request;

class CierreCajaChicaController extends Controller
{
    public function __construct()
    {
    }

    public function GenerarPDF(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->input();
            //$datos['nroliquidacion'] = array_key_exists('idPersona',$datos)? $datos['idPersona']:NULL;
            $datos['nroliquidacion'] = array_key_exists('nroliquidacion',$datos)? $datos['nroliquidacion']:NULL;
            $datos['codusu'] = array_key_exists('codusu',$datos)? $datos['codusu']:NULL;
            $datos['fechaapertura'] = array_key_exists('fechaapertura',$datos)? $datos['fechaapertura']:NULL;
            // $datos['idUsuario']=1;
           
            return CierreCajaChicaLogic::GenerarPDF($datos);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        //return RespuestaOperacion::enviarJsonObj($res);

    }

}