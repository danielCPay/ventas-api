<?php

namespace App\Logic\Ventas;

use App\Clases\RespuestaOperacion;
use App\Clases\General;
use App\Models\Ventas\VentasModel;

class NubeFactLogic
{    
    // RUTA para enviar documentos
    private const ruta = "https://api.nubefact.com/api/v1/c587a9be-4f9d-4b08-ab86-1aa9a5b1114b";

    //TOKEN para enviar documentos
    private const token = "47865c8ecc6f4f9e886bd238905cbb24fb5a6ce8b1604015ab6bae73a6ea3bcc";

    public static function EnviarComprobanteNubeFact(Array $datos) : RespuestaOperacion
    {
        $docventa = array();
        $docventa['venta'] = VentasModel::ObtenerDocVentaId(intval($datos['docventaid']));

        $serie = "";
        $tipo_cliente = "";
        $tipo_comprobante = "";

        $resultado = VentasModel::ObtenerDetalleDocVentaId($datos['docventaid']);
     
        if ($docventa['venta']->tipodocumentoid == 8) 
        {
            $serie = "FFF1";
            $tipo_cliente = 6;
            $tipo_comprobante = 1;
        }
        else if ($docventa['venta']->tipodocumentoid == 7) 
        {
            $serie = "BBB1";
            $tipo_cliente = 1;
            $tipo_comprobante = 2;
        }

        $total_gravada =$docventa['venta']->total / 1.18;
        $total_gravada = round($total_gravada, 2);

        $total_igv = $total_gravada * 0.18;
        $total_igv = round($total_igv, 2);

        $total = $docventa['venta']->total;
        $total = round($total, 2);

        $detalle = array();
        
         for ($i=0; $i < Count($resultado); $i++) {

            $precio_unitario = round($resultado[$i]-> precio , 2);      
                        
            $valor_unitario = $precio_unitario / 1.18;
            $valor_unitario = round($valor_unitario, 2);          

            $subtotal = $resultado[$i]-> importe / 1.18;
            $subtotal= round($subtotal,2);

            $igv =  $subtotal * 0.18;
            $igv = round($igv , 2);

            $detalle[] = array(
                "unidad_de_medida"=>'NIU',
                "codigo"=>$resultado[$i]->codigo,
                "descripcion"=>$resultado[$i]->descripcionproducto,
                "cantidad"=>$resultado[$i]->cantidad,
                "valor_unitario"            => $valor_unitario,
                "precio_unitario"           => $precio_unitario,
                "descuento"                 => "",
                "subtotal"                  => $subtotal,
                "tipo_de_igv"               => "1",
                "igv"                       => $igv,
                "total"                     => $subtotal + $igv,
                "anticipo_regularizacion"   => "false",
                "anticipo_documento_serie"  => "",
                "anticipo_documento_numero" => ""
            );
        }

        $data = array(
            "operacion"				            =>  "generar_comprobante",
            "tipo_de_comprobante"               =>  $tipo_comprobante,
            "serie"                             =>  $serie,
            "numero"				            =>  $docventa['venta']->numdoc,
            "sunat_transaction"			        =>  "1",
            "cliente_tipo_de_documento"	    	=>  $tipo_cliente,
            "cliente_numero_de_documento"	    =>  $docventa['venta']->numerodocumento,
            "cliente_denominacion"              =>  $docventa['venta']->razonsocial,
            "cliente_direccion"                 =>  $docventa['venta']->direccion,
            "cliente_email"                     =>  "",
            "cliente_email_1"                   =>  "",
            "cliente_email_2"                   =>  "",
            "fecha_de_emision"                  =>  date("d-m-Y", strtotime($docventa['venta']->fecha)),
            "fecha_de_vencimiento"              =>  "",
            "moneda"                            =>  $docventa['venta']->monedaid,
            "tipo_de_cambio"                    =>  "",
            "porcentaje_de_igv"                 =>  "18.00",
            "descuento_global"                  =>  "",
            "descuento_global"                  =>  "",
            "total_descuento"                   =>  "",
            "total_anticipo"                    =>  "",
            "total_gravada"                     =>  $total_gravada,
            "total_inafecta"                    =>  "",
            "total_exonerada"                   =>  "",
            "total_igv"                         =>  $total_igv,
            "total_gratuita"                    =>  "",
            "total_otros_cargos"                =>  "",
            "total"                             =>  $total,
            "percepcion_tipo"                   =>  "",
            "percepcion_base_imponible"         =>  "",
            "total_percepcion"                  =>  "",
            "total_incluido_percepcion"         =>  "",
            "detraccion"                        =>  "false",
            "observaciones"                     =>  "",
            "documento_que_se_modifica_tipo"    =>  "",
            "documento_que_se_modifica_serie"   =>  "",
            "documento_que_se_modifica_numero"  =>  "",
            "tipo_de_nota_de_credito"           =>  "",
            "tipo_de_nota_de_debito"            =>  "",
            "enviar_automaticamente_a_la_sunat" =>  "true",
            "enviar_automaticamente_al_cliente" =>  "false",
            "codigo_unico"                      =>  "",
            "condiciones_de_pago"               =>  "",
            "medio_de_pago"                     =>  "",
            "placa_vehiculo"                    =>  "",
            "orden_compra_servicio"             =>  "",
            "tabla_personalizada_codigo"        =>  "",
            "formato_de_pdf"                    =>  "",
            "items" =>  $detalle
        );
            
        $data_json = json_encode($data);
        //print_r($data_json);
       //Invocamos el servicio de NUBEFACT
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::ruta);
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Token token="'.self::token.'"',
            'Content-Type: application/json',
            )
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $respuesta  = curl_exec($ch);
        curl_close($ch);

        $leer_respuesta = json_decode($respuesta, true);

        if (isset($leer_respuesta['errors'])) {          
            $mensaje = $leer_respuesta['errors'];
            $exito = FALSE;
        } else {           
            $mensaje = 'El envío a Nube Fact se realizó con éxito.';
            $exito = TRUE;
        }    

        return new RespuestaOperacion($leer_respuesta, $mensaje, $exito);      
    }

    public static function AnularComprobanteNubeFact(Array $datos)
    {
        $docventa = array();
        $docventa['venta'] = VentasModel::ObtenerDocVentaId(intval($datos['docventaid']));

        $serie = "";
        $tipo_cliente = "";
        $tipo_comprobante = "";

        if ($docventa['venta']->tipodocumentoid == 8) 
        {
            $serie = "FFF1";
            $tipo_cliente = 6;
            $tipo_comprobante = 1;
        }
        else if ($docventa['venta']->tipodocumentoid == 7) 
        {
            $serie = "BBB1";
            $tipo_cliente = 1;
            $tipo_comprobante = 2;
        }

        $data = array(
            "operacion"				            =>  "generar_anulacion",
            "tipo_de_comprobante"               =>  $tipo_comprobante,
            "serie"                             =>  $serie,
            "numero"				            =>  $docventa['venta']->numdoc,
            "motivo"			                =>  "ERROR DEL SISTEMA",
            "codigo_unico"			            =>  "" 
        );
            
        $data_json = json_encode($data);

         //Invocamos el servicio de NUBEFACT
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, self::ruta);
         curl_setopt(
             $ch, CURLOPT_HTTPHEADER, array(
             'Authorization: Token token="'.self::token.'"',
             'Content-Type: application/json',
             )
         );
         curl_setopt($ch, CURLOPT_POST, 1);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $respuesta  = curl_exec($ch);
         curl_close($ch);
         
         $leer_respuesta = json_decode($respuesta, true);
         if (isset($leer_respuesta['errors'])) {          
            $mensaje = $leer_respuesta['errors'];
            $exito = FALSE;
        } else {           
            $mensaje = 'Se anuló correctamente.';
            $exito = TRUE;
        }    

        return new RespuestaOperacion($leer_respuesta, $mensaje, $exito);    
 
        //  $leer_respuesta = json_decode($respuesta, true);
        //  if (isset($leer_respuesta['errors'])) {
        //      //Mostramos los errores si los hay
        //      echo $leer_respuesta['errors'];
        //  } else {
 
        //  }
 
        //  return $leer_respuesta;
    }

    public static function ConsultarComprobanteNubeFact(Array $datos)
    {
        $docventa = array();
        $docventa['venta'] = VentasModel::ObtenerDocVentaId(intval($datos['docventaid']));

        $serie = "";
        $tipo_cliente = "";
        $tipo_comprobante = "";

        if ($docventa['venta']->tipodocumentoid == 8) 
        {
            $serie = "FFF1";
            $tipo_cliente = 6;
            $tipo_comprobante = 1;
        }
        else if ($docventa['venta']->tipodocumentoid == 7) 
        {
            $serie = "BBB1";
            $tipo_cliente = 1;
            $tipo_comprobante = 2;
        }

        $data = array(
            "operacion"				            =>  "consultar_comprobante",
            "tipo_de_comprobante"               =>  $tipo_comprobante,
            "serie"                             =>  $serie,
            "numero"				            =>  $docventa['venta']->numdoc           
        );
            
        $data_json = json_encode($data);

         //Invocamos el servicio de NUBEFACT
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, self::ruta);
         curl_setopt(
             $ch, CURLOPT_HTTPHEADER, array(
             'Authorization: Token token="'.self::token.'"',
             'Content-Type: application/json',
             )
         );
         curl_setopt($ch, CURLOPT_POST, 1);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $respuesta  = curl_exec($ch);
         curl_close($ch);

         $leer_respuesta = json_decode($respuesta, true);

        if (isset($leer_respuesta['errors'])) {          
            $mensaje = $leer_respuesta['errors'];
            $exito = FALSE;
        } else {           
            $mensaje = 'El Comprobante si existe.';
            $exito = TRUE;
        }    

        return new RespuestaOperacion($leer_respuesta, $mensaje, $exito);     
 
    }
}