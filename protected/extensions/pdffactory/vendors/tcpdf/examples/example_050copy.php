<?php

require_once('tcpdf_include.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = 'LogoAntoniano.jpg';
        $this->Image($image_file, 10, 10, 30, 15, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 10);
        // Title
        $this->Cell(0, 15, 'Mensa Antoniano Bologna', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

function DisplayTessera($vid,$vnome, $vcognome,$vscadenza) {

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setAlpha(0.5);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Andrea Baldi');
$pdf->setTitle('Tessera Antoniano');
$pdf->setSubject('TCPDF Tessera');
$pdf->setKeywords('TCPDF, PDF, tessera, Antoniano, Welcome');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'Mensa Antoniano', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
$pdf->setAlpha(1);
// ---------------------------------------------------------

// NOTE: 2D barcode algorithms must be implemented on 2dbarcode.php class file.

// set font
$pdf->setFont('helvetica', '', 11);

// add a page
$pdf->AddPage('P',"A6");
// Image method signature:
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Image example with resizing

$pdf->setJPEGQuality(75);
// Tessera Backgorund
$pdf->Image('images/bg_tessera.jpg', 10, 35, 90, 45, 'JPG', '', '', true, 300, '', false, false, 1, false, false, false);
//Antoniano Logo
$pdf->Image('images/LogoAntoniano.jpg', 10, 35, 30, 15, 'JPG', '', '', true, 300, '', false, false, 1, false, false, false);

// set style for barcode    
$style = array(
	'border' => 2,
	'vpadding' => 'auto',
	'hpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255)
	'module_width' => 1, // width of a single module in points
	'module_height' => 1 // height of a single module in points
);

// set up the correct parameter to generat the badge

$nome = 'Nome:';
$cognome = 'Cognome:';    
$tessera = 'Tessera N.:';  
$scadenza ='Scadenza:';  



// QRCODE,H : QR-CODE Best error correction
$pdf->write2DBarcode($vid.' '.$vnome.' '.$vcognome, 'QRCODE,H', 70, 45, 25, 25, $style, 'N');

$pdf->Text(10, 55, $nome.$vnome);
$pdf->Text(10, 60, $cognome.$vcognome);
$pdf->Text(10, 65, $tessera.$vid);
$pdf->Text(10, 70, $scadenza.$vscadenza);

//Close and output PDF document
$pdf->Output('/Applications/MAMP/htdocs/antoniano-ops/tessere/'.'TS-'.$vid.'.pdf', 'FI');

//============================================================+
// END OF FILE
//========
}

// Test the call
//DisplayTessera(12345,"Andrea", "Baldi","2022-06-30");