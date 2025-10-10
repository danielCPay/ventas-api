<?php

namespace App\Clases;

use App\Clases\General;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class Qr {
    private const RUTA_ARCHIVO = '/../../';

    public static function generar_qr($data,$rutaLogo=null) {

        $writer = new PngWriter();

        // Create QR code
        $qrCode = QrCode::create($data)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow()) 
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // Create generic logo
        if(!General::isEmpty($rutaLogo)){
            //$rutaLogo = public/img/logo_cqfll.jpg
            $logo = Logo::create(__DIR__ .self::RUTA_ARCHIVO.$rutaLogo)
                ->setResizeToWidth(50);
        }else{
            $logo = null;
        }
        
        // Create generic label
        $label = null; //Label::create('Label')->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode, $logo, $label);

        $dataUri = $result->getDataUri();

        //echo '<img src="'.$dataUri.'">';
        return $dataUri;
    }

}