<?php

namespace App\Logic\Ventas;

use App\Clases\RespuestaOperacion;
use App\Clases\General;
use App\Models\Ventas\VentasModel;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class PrintTicketLogic
{ 
    public static function PrintTicketVenta(Array $datos) : RespuestaOperacion
    {
        try {          
            //$connector = new WindowsPrintConnector("smb://DESKTOP-HK7A24L/PDF24");
            $connector = new WindowsPrintConnector("EPSON L3250 Series");
            $printer = new Printer($connector);
            $docventa = array();
            $docventa['venta'] = VentasModel::ObtenerDocVentaId(intval($datos['docventaid']));
       
            $resultado = VentasModel::ObtenerDetalleDocVentaId($datos['docventaid']);
            $numdoc = $docventa['venta']->numdoc;  
            $numerodocumento = $docventa['venta']->numerodocumento;   
            $fecha = date("d-m-Y", strtotime($docventa['venta']->fecha));
            $usercr = $docventa['venta']->usercr;   
            $total = round($docventa['venta']-> total , 2);  
            $fechaimpresion = date("d-m-Y H:i:s");  

            /* Print customer and order ID */

            $printer->text("BOTICA SERVIFARMA O.S". "\n");
            $printer->text("RUC:10167150336". "\n");
            $printer->text("DIREC: AV UNIVERSITARIA MZ D LOTE 15 URB". "\n");
            $printer->text("VILLA UNIVERSITARIA DE JOSE LISNER TUDELA". "\n");   
            $printer->text("\n");         
            $printer->feed(3);
           
            $printer->setJustification(Printer::JUSTIFY_CENTER);            
            $printer->text("TICKET: T001-". $numdoc .  "\n");
            $printer->text("\n");
            $printer->feed(3);

            $printer->text("F.EMISION:". $fecha .  "\n");
            $printer->text("FORMA PAGO: CONTADO". "\n");
            $printer->text("F.IMPRESION:". $fechaimpresion .  "\n");
            $printer->text("USUARIO:". $usercr .  "\n");
            $printer->text("----------------------------------------\n");
           
            function buatBaris4Kolom($kolom1, $kolom2, $kolom3, $kolom4) {
                // Mengatur lebar setiap kolom (dalam satuan karakter)
                $lebar_kolom_1 = 4;
                $lebar_kolom_2 = 20;
                $lebar_kolom_3 = 6;
                $lebar_kolom_4 = 7;
        
                // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
                $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
                $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
                $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
                $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);
        
                // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
                $kolom1Array = explode("\n", $kolom1);
                $kolom2Array = explode("\n", $kolom2);
                $kolom3Array = explode("\n", $kolom3);
                $kolom4Array = explode("\n", $kolom4);
        
                // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
                $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));
        
                // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
                $hasilBaris = array();
        
                // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
                for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {
        
                    // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                    $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                    $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");
        
                    // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                    $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
                    $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);
        
                    // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                    $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
                }
        
                // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
                return implode($hasilBaris, "\n") . "\n";
            }   
            $printer->text(buatBaris4Kolom("CANT", "PRODUCTO", "P.U", "IMP."));
            $printer->text("----------------------------------------\n");
            for ($i=0; $i < Count($resultado); $i++) {

                $precio_unitario = round($resultado[$i]-> precio , 2);      
                $importe = round($resultado[$i]-> importe , 2); 
                
                $descripcionproducto = $resultado[$i]->descripcionproducto;
                $cantidad=round($resultado[$i]-> cantidad , 2);              
                
                $printer->text(buatBaris4Kolom($cantidad, $descripcionproducto, $precio_unitario, $importe));               
            }
        }catch (Exception $e) {
            echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
        }
        $printer->text("----------------------------------------\n");
        $printer->text(buatBaris4Kolom('', '', "Total", $total));
        $printer->text("\n");
        $printer->feed(3);
        /*
            Podemos poner también un pie de página
        */
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("GRACIAS POR SU VISITA" . "\n");   
        //$printer->cut();     
        /* Close printer */
        $printer -> close();

        return new RespuestaOperacion(null, null, true);
    }

   


}