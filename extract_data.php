<?php
//include('include/pdf2text.php');
//$result = pdf2text ('dokumente/rechnung.pdf');
//$result = pdf2text ('dokumente/101163569.pdf');
include('include/PdfParser.php');
//$filename='dokumente/RG100062904323_02102019.pdf';
$filename='dokumente/rechnung_telekom.pdf';
$pdf = new PdfParser();
$result = $pdf->parseFile($filename);
echo $result;
?>