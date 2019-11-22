<?php

require_once 'dompdf/autoload.inc.php';
include_once 'mail/class.phpmailer.php';

$phone      = $_POST['phone'];
$user       = $_POST['user'];
$trade      = $_POST['trade'];
$portfolio  = $_POST['portfolio'];
$experience = $_POST['experience'];
$date       = $_POST['date'];
$lang       = $_POST['lang'];

use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

ob_start();

if($lang  == 'en'){
        require('templates/en-attachment.php');
} elseif ($lang == 'cz'){
        require('templates/cz-attachment.php');     
}

$html = ob_get_contents();
ob_get_clean();
$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$pdf = $dompdf->output();



//$base =  $_POST['data'];
/*ob_start();
var_dump($_POST);
$r = ob_get_clean();*/


$m = new PHPMailer();
$m->IsSMTP();
$m->Host = 'mail.globtrex.cz';
$m->SMTPAuth = true;
$m->Username = 'backoffice@globtrex.cz';
$m->Password = 'tmyMWNE';
$m->From = 'backoffice@globtrex.cz';
$m->FromName = 'backoffice';
$m->Subject = 'New signed declaration from Globtrex';
$m->AddStringAttachment($pdf, 'attachment.pdf');
$m->IsHTML(true);
$m->Body = "Username: " . $user . "<br/> Phone: " . $phone . "<br/> Trade size & volume: " . $trade . "<br/> Size of portfolio: " . $portfolio . "<br/> Professional Experience: " . $experience . "<br/>Date: " . $date; 
$m->WordWrap = 50;
$m->CharSet = "utf-8";
$m->AddAddress('backoffice@globtrex.com');
$m->Send();   
