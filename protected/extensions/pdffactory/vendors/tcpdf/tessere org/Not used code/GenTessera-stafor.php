<?php

require_once('tcpdf_include.php');




function DisplayTessera($pdf,$vid,$vnome, $vcognome,$vscadenza, $a4x,$a4y) {
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



// NOTE: 2D barcode algorithms must be implemented on 2dbarcode.php class file.
// set font
$pdf->setFont('helvetica', '', 11);

// add a page of size 74 x 105 mm equivalent
//$pdf->AddPage('L',"A4");
// Image method signature:
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Image example with resizing

$pdf->setJPEGQuality(75);
// Tessera Backgorund
$pdf->Image('images/bg_tessera.jpg', $a4x+10, $a4y+20, 90, 50, 'JPG', '', '', true, 300, '', false, false, 1, false, false, false);
//Antoniano Logo
$pdf->Image('images/LogoAntoniano.jpg', $a4x+70, $a4y+20, 30, 15, 'JPG', '', '', true, 300, '', false, false, 1, false, false, false);

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
$pdf->write2DBarcode($vid.' '.$vnome.' '.$vcognome, 'QRCODE,H', $a4x+45, $a4y+40, 24, 24, $style, 'N');

$pdf->Text($a4x+10, $a4y+20, $nome.$vnome);
$pdf->Text($a4x+10, $a4y+25, $cognome.$vcognome);
$pdf->Text($a4x+10, $a4y+30, $tessera.$vid);
$pdf->Text($a4x+10, $a4y+65, $scadenza.$vscadenza);

}


function GenTessera() {

// create new PDF document of A4 format and fill with 9 tessera for each page.
$doc = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$doc->AddPage('L',"A4");

$xpos = array(
	0,
	95,
	190);
$ypos = array(
		0,
		55,
		110);

for($i = 0, $xsize = count($xpos); $i < $xsize; ++$i) {
    for($j = 0, $ysize = count($ypos); $j < $ysize; ++$j) {
		DisplayTessera($doc,12344,"Andrea", "Baldi","2022-04-30",$xpos[$i] ,$ypos[$j]);
	}
}
$doc->Output('/Applications/MAMP/htdocs/antoniano-ops/tessere/'.'TS-'.'print'.'.pdf', 'FI');
}

GenTessera();


