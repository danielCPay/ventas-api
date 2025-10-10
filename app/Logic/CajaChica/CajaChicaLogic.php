<?php

namespace App\Logic\CajaChica;

use App\Clases\RespuestaOperacion;
use App\Clases\General;
use App\Models\CajaChica\CajaChicaModel;

class CajaChicaLogic
{

    public static function Resumen_Caja_Gastos(String $nroliquidacion): RespuestaOperacion
    {
        $lista = CajaChicaModel::Resumen_Caja_Gastos($nroliquidacion);
        return new RespuestaOperacion($lista);
    }

    public static function Resumen_Caja_Ingreso(String $codusu): RespuestaOperacion
    {
        $lista = CajaChicaModel::Resumen_Caja_Ingreso($codusu);
        return new RespuestaOperacion($lista);
    }

    public static function Resumen_Caja_Tarjetas(String $nroliquidacion): RespuestaOperacion
    {
        $lista = CajaChicaModel::Resumen_Caja_Tarjetas($nroliquidacion);
        return new RespuestaOperacion($lista);
    }

    public static function Resumen_Caja_Ventas(String $nroliquidacion): RespuestaOperacion
    {
        $lista = CajaChicaModel::Resumen_Caja_Ventas($nroliquidacion);
        return new RespuestaOperacion($lista);
    }

    public static function Resumen_Caja_Productos(String $nroliquidacion): RespuestaOperacion
    {
        $lista = CajaChicaModel::Resumen_Caja_Productos($nroliquidacion);
        return new RespuestaOperacion($lista);
    }

    public static function Genera_Numero_CajaChica(): RespuestaOperacion
    {
        $lista = CajaChicaModel::Genera_Numero_CajaChica();
        return new RespuestaOperacion($lista);
    }

    public static function Listado(
        Int $page_index,
        Int $page_size,
        $fecha_inicio,
        $fecha_fin,
        $codusu
    ): RespuestaOperacion {
        if (General::isEmpty($fecha_inicio)) {
            $fecha_inicio = NULL;
        }
        if (General::isEmpty($fecha_fin)) {
            $fecha_fin = NULL;
        }
        if (General::isEmpty($codusu)) {
            $codusu = NULL;
        }

        $resultado = CajaChicaModel::Listado($page_index, $page_size, $fecha_inicio, $fecha_fin, $codusu);
        return new RespuestaOperacion($resultado);
    }

    public static function Insertar_Actualizar(array $datos): RespuestaOperacion
    {
        $resultado = CajaChicaModel::Insertar_Actualizar($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;

        if (!General::isEmpty($resultado)) {
            $mensaje = $resultado->mensaje;
            unset($resultado->mensaje);
            $exito = ($resultado->exito == 0 ? FALSE : TRUE);
            unset($resultado->exito);
            if (!$exito) {
                $resultado = null;
            }
        }

        return new RespuestaOperacion($resultado, $mensaje, $exito);
    }

    public static function Cierre_Caja(array $datos): RespuestaOperacion
    {
        $resultado = CajaChicaModel::Cierre_Caja($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;

        if (!General::isEmpty($resultado)) {
            $mensaje = $resultado->mensaje;
            unset($resultado->mensaje);
            $exito = ($resultado->exito == 0 ? FALSE : TRUE);
            unset($resultado->exito);
            if (!$exito) {
                $resultado = null;
            }
        }

        return new RespuestaOperacion($resultado, $mensaje, $exito);
    }

    public static function Verificar_CajaChica_Usuario(String $codusu): RespuestaOperacion
    {
        $resultado = CajaChicaModel::Verificar_CajaChica_Usuario($codusu);
        if (General::isEmpty($resultado)) {
            $resultado = NULL;
        }
        return new RespuestaOperacion($resultado);
    }

    public static function Verificar_CajaChica_Num_Liquidacion(String $nroliquidacion): RespuestaOperacion
    {
        $resultado = CajaChicaModel::Verificar_CajaChica_Num_Liquidacion($nroliquidacion);
        if (General::isEmpty($resultado)) {
            $resultado = NULL;
        }
        return new RespuestaOperacion($resultado);
    }
}
