<?php

namespace App\Http\Controllers\CajaChica;
use App\Clases\General;
use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\CajaChica\CajaChicaLogic;
use Illuminate\Http\Request;

class CajaChicaController extends Controller
{
    public function __construct()
    {
    }   

    public function Resumen_Caja_Gastos(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos=(array)$request->input();    
            $nroliquidacion = $datos['nroliquidacion'];
            $res = CajaChicaLogic::Resumen_Caja_Gastos($nroliquidacion);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function Resumen_Caja_Ingreso(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos=(array)$request->input();    
            $codusu = $datos['codusu'];
            $res = CajaChicaLogic::Resumen_Caja_Ingreso($codusu);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }
    public function Resumen_Caja_Tarjetas(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos=(array)$request->input();    
            $nroliquidacion = $datos['nroliquidacion'];
            $res = CajaChicaLogic::Resumen_Caja_Tarjetas($nroliquidacion);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }
    public function Resumen_Caja_Ventas(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos=(array)$request->input();    
            $nroliquidacion = $datos['nroliquidacion'];
            $res = CajaChicaLogic::Resumen_Caja_Ventas($nroliquidacion);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function Resumen_Caja_Productos(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos=(array)$request->input();    
            $nroliquidacion = $datos['nroliquidacion'];
            $res = CajaChicaLogic::Resumen_Caja_Productos($nroliquidacion);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function Genera_Numero_CajaChica(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos=(array)$request->input();    
            //$nroliquidacion = $datos['nroliquidacion'];
            $res = CajaChicaLogic::Genera_Numero_CajaChica();

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }
  
  
    public function Listado(Request $request)
    {     
        $res = new RespuestaOperacion();
        try {
            $page_index = intval($request->input("page_index", 1)) - 1;
            $page_size = intval($request->input("page_size", 10));
            
            $fecha_inicio = $request->input("fecha_inicio", NULL);
            $fecha_fin = $request->input("fecha_fin", NULL);
            $codusu = $request->input("codusu", NULL);

            $res = CajaChicaLogic::Listado(
                $page_index, $page_size, $fecha_inicio, $fecha_fin, $codusu
            );
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function Insertar_Actualizar(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("caja");            
            $res = CajaChicaLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }  

    
    public function Cierre_Caja(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("caja");            
            $res = CajaChicaLogic::Cierre_Caja($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    } 

    public function Verificar_CajaChica_Usuario(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->input();
            $codusu = $datos['codusu'];       
            $res = CajaChicaLogic::Verificar_CajaChica_Usuario($codusu);
        } catch (\Exception $e) {
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function Verificar_CajaChica_Num_Liquidacion(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->input();
            $nroliquidacion = $datos['nroliquidacion'];       
            $res = CajaChicaLogic::Verificar_CajaChica_Num_Liquidacion($nroliquidacion);
        } catch (\Exception $e) {
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }


}