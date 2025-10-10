<?php

namespace App\Logic\CajaChica;

use App\Clases\RespuestaOperacion;
use App\Clases\General;

use App\Models\CajaChica\CajaChicaModel;

class CierreCajaChicaLogic
{    

    public static function GenerarPDF(Array $datos) //: RespuestaOperacion
    {
        $cierrecaja = array();
        // $colegiado['persona'] = PersonaModel::Obtener(intval($datos['idPersona']),$datos['dni'],$datos['cqf'],$datos['ruc']);
        
        // if(General::isEmpty($colegiado['persona'])){
        //     return "";
        // }

        $cierrecaja['fechaapertura'] = $datos['fechaapertura'];
        $cierrecaja['codusu'] = $datos['codusu'];
        $cierrecaja['nroliquidacion'] = $datos['nroliquidacion'];

        $cierrecaja['cajaingreso'] = CajaChicaModel::Resumen_Caja_Ingreso($datos['codusu']);
        $cierrecaja['cajagastos'] = CajaChicaModel::Resumen_Caja_Gastos($datos['nroliquidacion']);
        $cierrecaja['cajatarjetas'] = CajaChicaModel::Resumen_Caja_Tarjetas($datos['nroliquidacion']);
        $cierrecaja['cajaventas'] = CajaChicaModel::Resumen_Caja_Ventas($datos['nroliquidacion']);
        $cierrecaja['cajaproductos'] = CajaChicaModel::Resumen_Caja_Productos($datos['nroliquidacion']);
        // $colegiado['laboral'] = LaboralModel::Listado($datos['idPersona']);
        // $colegiado['profesional'] = ProfesionalModel::Listado($datos['idPersona']);

        $pdf_ficha = app('dompdf.wrapper');
        //Pdf::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf')
        $pdf_ficha->setPaper('a4', 'landscape')->setOptions(['isRemoteEnabled' => true])
            ->loadView(
                'formatoPDF/pdf_cierreCaja',array('cierrecaja'=>$cierrecaja)
            );

        //Renderiza el archivo primero
        $pdf_ficha->render();

        // Output the generated PDF to Browser
        return $pdf_ficha->stream();

      
    }

}