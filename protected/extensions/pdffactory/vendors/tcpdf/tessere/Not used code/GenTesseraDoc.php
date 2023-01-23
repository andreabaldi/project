<?php

require_once('tcpdf_include.php');

function CreateTessera($vid, $vfid, $vnome, $vcognome,$vscadenza) {

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Andrea Baldi');
$pdf->setTitle('Tessera Antoniano');
$pdf->setSubject('TCPDF Tessera');
$pdf->setKeywords('TCPDF, PDF, tessera, Antoniano, Welcome');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set auto page breaks
$pdf->setAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
// ---------------------------------------------------------

// NOTE: 2D barcode algorithms must be implemented on 2dbarcode.php class file.
// set font
$pdf->setFont('helvetica', '', 11);

// add a page of size 74 x 105 mm equivalent
$pdf->AddPage('L',"A7");
// Image method signature:
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Image example with resizing

$pdf->setJPEGQuality(75);
// Tessera Backgorund
$pdf->Image('tcpdf/tessere/images/bg_tessera.jpg', 10, 20, 90, 50, 'JPG', '', '', true, 300, '', false, false, 1, false, false, false);
//Antoniano Logo
$pdf->Image('tcpdf/tessere/images/LogoAntoniano.jpg', 70, 20, 30, 15, 'JPG', '', '', true, 300, '', false, false, 1, false, false, false);

// set style for barcode    
$style = array(
	'border' => true,
	'vpadding' => 'auto',
	'hpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => array(255,255,255),
	'module_width' => 1, // width of a single module in points
	'module_height' => 1 // height of a single module in points
);


// set up the correct parameter to generat the badge

$nome = 'Nome:';
$cognome = 'Cognome:';    
$tessera = 'Tessera N.:';  
$scadenza ='Scadenza:';  

// QRCODE,H : QR-CODE Best error correction
$pdf->write2DBarcode($vid.' '.$vnome.' '.$vcognome, 'QRCODE,H', 45, 40, 24, 24, $style, 'N');


$pdf->Text(10, 20, $nome.$vnome);
$pdf->Text(10, 25, $cognome.$vcognome);
$pdf->Text(10, 30, $tessera.$vid);
$pdf->Text(10, 65, $scadenza.$vscadenza);

//Close and output PDF document
$pdf->Output('/Applications/MAMP/htdocs/antoniano-ops/tessere/'.'TS-'.$vfid.'.pdf', 'F');

//============================================================+
// END OF FILE
//========
}

// Test the call
CreateTessera(1555,1555,"Andrea", "Baldi","2022-04-30");