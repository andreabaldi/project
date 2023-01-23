<?php

require_once('tcpdf_include.php');

function DisplayTessera($vid,$vnome, $vcognome,$vscadenza) {

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
$pdf->Image('images/bg_tessera.jpg', 10, 20, 90, 50, 'JPG', '', '', true, 300, '', false, false, 1, false, false, false);
//Antoniano Logo
$pdf->Image('images/LogoAntoniano.jpg', 70, 20, 30, 15, 'JPG', '', '', true, 300, '', false, false, 1, false, false, false);

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
$pdf->write2DBarcode($vid.' '.$vnome.' '.$vcognome, 'QRCODE,H', 45, 40, 24, 24, $style, 'N');

$pdf->Text(10, 20, $nome.$vnome);
$pdf->Text(10, 25, $cognome.$vcognome);
$pdf->Text(10, 30, $tessera.$vid);
$pdf->Text(10, 65, $scadenza.$vscadenza);

//Close and output PDF document
$pdf->Output('/Applications/MAMP/htdocs/antoniano-ops/tessere/'.'TS-'.$vid.'.pdf', 'FI');

//============================================================+
// END OF FILE
//========
}

// Test the call

DisplayTessera(1229,"Stoian Constantin","Gheorghe","2022-08-31");
DisplayTessera(1230,"Jouini","Lassaad","2022-08-31");
DisplayTessera(1231,"Castellana","Alexio","2022-08-31");
DisplayTessera(1232,"El Mehdi","Ouarrad","2022-08-31");
DisplayTessera(1233,"Somandru","Vasile","2022-08-31");
DisplayTessera(1234,"Berto","Massimo","2022-08-31");
DisplayTessera(1235,"MARINO","GUELELMO","2022-08-31");
DisplayTessera(1236,"BURNEO","CADILLO","2022-08-31");
DisplayTessera(1237,"Akrout","Lofti","2022-08-31");
DisplayTessera(1238,"GULEO","CABDI BARE","2022-08-31");
DisplayTessera(1239,"KHAMIS","OMAR","2022-08-31");
DisplayTessera(1240,"ABDELHAK","TAIBOUR","2022-08-31");
DisplayTessera(1241,"IBRAHIM","SAADALLAH","2022-08-31");
DisplayTessera(1242,"SAVJICHIT","GRIBORII","2022-08-31");
DisplayTessera(1243,"COSTEL","COJOCARU","2022-08-31");
DisplayTessera(1244,"MASIRI","AKMAN","2022-08-31");
DisplayTessera(1245,"TORVINO","GIUSEPPE","2022-08-31");
DisplayTessera(1246,"CHELLNA","FAISAL IQBAL","2022-08-31");
DisplayTessera(1247,"CARBACS","FRANCESZEK ANDREJ","2022-08-31");
DisplayTessera(1248,"El Mostapha","Zghaidi","2022-08-31");
DisplayTessera(1249,"Belloumi","Rajae","2022-08-31");
DisplayTessera(1250,"Gois Da Silva","Marcello Filho","2022-08-31");
DisplayTessera(1251,"Romagnoli","Marco","2022-08-31");
DisplayTessera(1252,"Lamine","Sane","2022-08-31");
DisplayTessera(1253,"Sifo","Gianluca","2022-08-31");
DisplayTessera(1254,"Montanari","Maria Flora","2022-08-31");
DisplayTessera(1255,"Mahamed","Rashid","2022-08-31");
DisplayTessera(1256,"Torres Valdes","JOSUE ABRAHAN","2022-08-31");
DisplayTessera(1257,"Josue","Abrham","2022-08-31");
DisplayTessera(1258,"Lamine","Diaone","2022-08-31");
DisplayTessera(1259,"Sawane","Lamin","2022-08-31");
DisplayTessera(1260,"Amran","Ahmed","2022-08-31");
DisplayTessera(1261,"Ove","John","2022-08-31");
DisplayTessera(1262,"Zharkovska","Veronika","2022-08-31");
DisplayTessera(1263,"Scaglioso","Luca","2022-08-31");
DisplayTessera(1264,"Petryshina","Svitlana","2022-08-31");
DisplayTessera(1265,"SIDIBE","MOHAMED SAIDOU","2022-08-31");
DisplayTessera(1266,"BOTTAZ","SERGIO","2022-08-31");
DisplayTessera(1267,"RAMAZI","SAMXHARADZI","2022-08-31");
DisplayTessera(1268,"INNOCENTE","JOHN","2022-08-31");
DisplayTessera(1269,"Suriano","Antonio","2022-08-31");
DisplayTessera(1270,"FACCHINI","JURI","2022-08-31");
DisplayTessera(1271,"MOUDEN","JAMAA","2022-08-31");
DisplayTessera(1272,"IBRAAHIM","CISMAN DATTIR","2022-08-31");
DisplayTessera(1273,"Saiss","Mochine","2022-08-31");
DisplayTessera(1274,"Darif","Khalid","2022-08-31");
DisplayTessera(1275,"Kipiolliehko","Kiriushenko","2022-08-31");
DisplayTessera(1276,"Hafsi","Karim","2022-08-31");
DisplayTessera(1277,"Beshim","Romdhini","2022-08-31");
DisplayTessera(1278,"Camara","Mohamed","2022-08-31");
DisplayTessera(1279,"Tchijou","Jean Calvin","2022-08-31");
DisplayTessera(1280,"Rasheed","Hamid","2022-08-31");
DisplayTessera(1281,"Lupone","Mario Mauro","2022-08-31");
DisplayTessera(1282,"Jordanescu","Ion veronel","2022-08-31");
DisplayTessera(1283,"ZHELEPOLA","DHANUSHKA","2022-08-31");
DisplayTessera(1284,"MARCELO","HENRIQUE","2022-08-31");
DisplayTessera(1285,"BRANDO","SABRINA","2022-08-31");
DisplayTessera(1286,"Gavoni","Luca","2022-08-31");
DisplayTessera(1287,"Lordan","Vasilica","2022-08-31");
DisplayTessera(1288,"Renzetti","Sergio","2022-08-31");
DisplayTessera(1289,"Aadan","Suglal","2022-08-31");
DisplayTessera(1290,"Onojovbo","Gods Power","2022-08-31");
DisplayTessera(1291,"Hotel","Aile","2022-08-31");
DisplayTessera(1292,"Nurradin","Mohamed","2022-08-31");
DisplayTessera(1293,"Singh","Manider","2022-08-31");
DisplayTessera(1294,"MATTEI","NICOLAE PALA","2022-08-31");
DisplayTessera(1295,"ABBAS","AHMED JHIRE","2022-08-31");
DisplayTessera(1296,"KASER","THABIT MOHAMED","2022-08-31");
DisplayTessera(1297,"ABDULLAHI","ABSHIR TIRO","2022-08-31");
DisplayTessera(1298,"LARAJI","AMINE","2022-08-31");
DisplayTessera(1299,"VISAGGIO","MICHELE","2022-08-31");
DisplayTessera(1300,"DE MATTEI","PIERO","2022-08-31");
DisplayTessera(1301,"GUEMM CAUE","LUIS ALBERTO","2022-08-31");
DisplayTessera(1302,"GNALE","MASSIB","2022-08-31");
DisplayTessera(1303,"KIPHOLLENKO","KIRUSHEMCHENCO","2022-08-31");
DisplayTessera(1304,"DORIAN","DANUTA","2022-08-31");
DisplayTessera(1305,"Samaancusa","Mariastella","2022-08-31");
DisplayTessera(1306,"Moutahir","Nabil","2022-08-31");
DisplayTessera(1307,"Ronchi","Giovanni","2022-08-31");
DisplayTessera(1308,"Qiu","Yinwei","2022-08-31");
DisplayTessera(1309,"Ghali","Hassib","2022-08-31");
DisplayTessera(1310,"Guerra","Calle Luis Alberto","2022-08-31");
DisplayTessera(1311,"ElHachimi","Ayman","2022-08-31");
DisplayTessera(1312,"Ahmed","Jouini","2022-08-31");
DisplayTessera(1313,"Kipollehko","Kiriushchenko","2022-08-31");
DisplayTessera(1314,"HAMED","YAHYA","2022-08-31");
DisplayTessera(1315,"BOTTO","NARBERT","2022-08-31");
DisplayTessera(1316,"Condemi","Mario","2022-08-31");
DisplayTessera(1317,"Alani","Jamil","2022-08-31");
DisplayTessera(1318,"Barone","Mulusew","2022-08-31");
DisplayTessera(1319,"EL MEDHI","QUARRADI","2022-08-31");
DisplayTessera(1320,"HAMMAIRI","SAMIR","2022-08-31");
DisplayTessera(1321,"HAKIM","ABDI","2022-08-31");
DisplayTessera(1322,"BIANZONE","GIAN CARLO","2022-08-31");
DisplayTessera(1323,"BURDI","FABIO","2022-08-31");
DisplayTessera(1324,"MULUSEW","DEBRE ZEIT","2022-08-31");
DisplayTessera(1325,"Turuta","Mirela","2022-08-31");
DisplayTessera(1326,"DANIELE","SCARAFILE","2022-08-31");
DisplayTessera(1327,"BOUDAL","OVALIA","2022-08-31");
DisplayTessera(1328,"CALLIGARI","GIANCARLO","2022-08-31");
DisplayTessera(1329,"LODI","ANTONIO","2022-08-31");
DisplayTessera(1330,"SING","AMANDNDA","2022-08-31");
DisplayTessera(1331,"AHMED","JAMIL","2022-08-31");
DisplayTessera(1332,"OGUMMA","GIACOMO","2022-08-31");
DisplayTessera(1333,"FIANU","JAMES KOFI","2022-08-31");
DisplayTessera(1334,"SHAOTI","LIN","2022-08-31");
DisplayTessera(1335,"SERGIO","MANESB","2022-08-31");
DisplayTessera(1336,"SHINVARRI","HIJRAT","2022-08-31");
DisplayTessera(1337,"MORSO","ALESSANDRO","2022-08-31");
DisplayTessera(1338,"BAYE","OUSMANE SARR","2022-08-31");
DisplayTessera(1339,"JACOB","OGUMA","2022-08-31");
DisplayTessera(1340,"SPINELLI","MORENO","2022-08-31");
DisplayTessera(1341,"PACHECO","HUARAN","2022-08-31");
DisplayTessera(1342,"SHANNON BETWAN","ABDULANFEA NOEMI","2022-08-31");
