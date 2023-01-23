<?php
//create a TCPDF instance with the params from tcpdfOptions from config/main.php
$pdf=Yii::app()->pdfFactory->getTCPDF(); 

//use this instance like explained in [TCPDF examples](http://www.tcpdf.org/examples.php "") 
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->addPage();
$pdf->write(0,'Hello world');
$pdf->Output();

//create a TCPDF instance with other tcpdfOptions than the configured default.
$pdf=Yii::app()->pdfFactory->getTCPDF(array('format'=>'A5')); 


//create a FPDI instance (always brigded mode so FPDI extends TCPDF)
//see [FPDI](http://www.setasign.com/products/fpdi/about/ "") 
$pdf=Yii::app()->pdfFactory->getFPDI(); //other options like above  
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');

//import the template
$pdf->setSourceFile('...path to pdf template file...');
$tplidx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplidx, 10, 10, 90);

$pdf->write(0,'Hello world');

$pdf->Output();  

