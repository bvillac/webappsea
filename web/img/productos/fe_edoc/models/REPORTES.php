<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of REPORTES
 *
 * @author root
 */
namespace app\modules\fe_edoc\models;

use Yii;

class REPORTES {

    public function crearBaseReport() {
        $mPDF1 = yii::$app->ePdf->mpdf('utf-8', 'A4', '', '', 15, 15, 16, 16, 9, 9, 'P'); //Esto lo pueden configurar como quieren, para eso deben de entrar en la web de MPDF para ver todo lo que permite.
        $mPDF1->useOnlyCoreFonts = true;
        
        $mPDF1->SetAuthor("Utimpor");
        $mPDF1->SetCreator("Utimpor");
        //$mPDF1->SetWatermarkText(Yii::t('DOCUMENTOS', 'PRINTED INFORMATION PROVIDED IS VOID IN PROOF TEST ENVIRONMENT'));
        //$mPDF1->showWatermarkText = true;
        //$mPDF1->watermark_font = 'DejaVuSansCondensed';
        //$mPDF1->watermarkTextAlpha = 0.5;
        $mPDF1->SetDisplayMode('fullpage');
        
        //$this->FooterPDF($mPDF1);
        
        //$mPDF1->SetHeader('<div>HIosla como estas</div>');
        //$mPDF1->SetFooter('Pie de página');
        //$mPDF1->SetWatermarkImage("/images/logo.jpg");
        //$mPDF1 ->showWatermarkImage = true;
        
        //Load a stylesheet
        //$stylesheet = file_get_contents(yii::$app->theme->baseUrl.'/css/print.css');
        //$mPDF1->WriteHTML($stylesheet, 1);
        return $mPDF1;
    }
    
    //Pie de página
    public function FooterPDF($mPDF1) {
        $mPDF1->SetY(-10);
        $mPDF1->SetFont('Arial', 'I', 8);
        //$mPDF1->Cell(0, 10, 'Page /{nb}', 0, 0, 'C');
        $mPDF1->Cell(0,10,'Este es el pie de página creado con el método Footer() de la clase creada PDF que hereda de FPDF','T',0,'C');
    }

}
