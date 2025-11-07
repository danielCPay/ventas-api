<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;
use Dompdf\Dompdf;
use App\Models\Mantenedores\ProductoModel;

class BarcodeController extends Controller
{
    public function imprimirCodigos()
    {
        $productos = ProductoModel::ListadoProductosPresentacionCodigoBarra();

        $barcode = new DNS1D();
        $barcode->setStorPath(storage_path('barcodes'));

        $html = '<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Etiquetas 40x30mm</title>
            <style>
    @page { 
        size: 40mm 30mm;
        margin: 0;
    }
    body {
        margin: 0;
        padding: 0;
        background: #fff;
        font-family: Arial, sans-serif;
    }
    .contenedor {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        align-content: flex-start;
        width: 100%;
        margin: 3mm 0 0 0; /* 🔹 Baja un poco sin mover a la derecha */
        padding-left: 0mm; /* 🔹 Asegura que empiece desde el borde */
    }
    .etiqueta {
        width: 40mm;
        height: 30mm;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        page-break-inside: avoid;
        margin: 0;
        padding: 0;
    }
    .nombre {
        font-size: 9px;
        font-weight: bold;
        white-space: nowrap;
        overflow: hidden;
        width: 95%;
        text-overflow: ellipsis;
        margin-bottom: 2px;
    }
    img {
        width: 85%;
        height: auto;
        margin: 2px 0;
        padding: 0;
    }
    .codigo {
        font-size: 8px;
        margin-top: 0;
    }
    .precio {
        font-size: 9px;
        font-weight: bold;
        margin-top: 1px;
    }
</style>

        </head>
        <body>';

        foreach ($productos as $p) {
            $codigo = trim($p->codigo ?? '');
            $nombre = htmlspecialchars($p->decripcionpresentacion ?? '');
            $precio = number_format($p->precio ?? 0, 2);
            $barcodeImage = $barcode->getBarcodePNG($codigo, 'C128', 1.0, 45); // ajusta grosor y altura

            $html .= '
                <div class="etiqueta">
                    <div class="nombre">' . $nombre . '</div>
                    <img src="data:image/png;base64,' . $barcodeImage . '" alt="' . $codigo . '">
                    <div class="codigo">' . $codigo . '</div>
                    <div class="precio">S/ ' . $precio . '</div>
                </div>';
        }

        $html .= '</body></html>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // ⚙️ Conversión: 1mm = 2.83465pt → 40mm = 113.39pt, 30mm = 85.04pt
        $dompdf->setPaper([0, 0, 113.39, 85.04], 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="etiquetas_40x30.pdf"');
    }
}