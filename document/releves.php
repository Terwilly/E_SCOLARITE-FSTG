<?php
session_start();
include_once "../connect.php";
if(!isset($_SESSION["identifiant"])){
    header("Location:../index.php");
}
?>

<?php
require('../fpdf/fpdf.php');

//Création d'un nouveau doc pdf (Portrait, en mm , taille A4)
$pdf = new FPDF('P', 'mm', 'A4');

//Ajouter une nouvelle page
$pdf->AddPage();

// entete
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(130,5,'ROYAUME DU MAROC',0,0);
$pdf->Cell(130,5,'',0,1);
// $pdf->Image('fpdf/logofstg.png',null,null,10,15);
$pdf->Cell(130.5,5,utf8_decode('Université Cadi Ayyad'),0,0);
$pdf->Cell(-1,5,$pdf->Image('../fpdf/logofstg.png',93,10,-250),0,0);
$pdf->Cell(60,5,utf8_decode('جامعة القاضي عياد'),0,1,);
$pdf->Cell(130,5,utf8_decode('Faculté des Sciences et Techniques'),0,0);
$pdf->Cell(59,5,'FSTG-en darija',0,1);
$pdf->Cell(130,5,utf8_decode('Guéliz - Marrakech'),0,0);
$pdf->Cell(59,5,utf8_decode('Guéliz - Marrakech en darija'),0,1);

// Saut de ligne 
$pdf->Ln(3);
$pdf->SetFont('Arial', 'U', 10);
$pdf->Cell(130,5,'Services des Affaires Estudiantines ',0,0);
$pdf->Cell(59,5,'Services des Affaires - Darija ',0,1);
// Saut de ligne
$pdf->Ln(15);


// Police Arial gras 16
$pdf->SetFont('Arial', 'BU', 16);

// Titre
$pdf->Cell(0, 10, 'ATTESTATION DE NOTES', '', 1, 'C');
// Saut de ligne
$pdf->Ln(15);
$pdf->Write(7, utf8_decode("Je soussigné, Directeur \n"));
$pdf->Ln(40);
$pdf->Cell(150, 6, '', 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(21, 2, '0',0, 1);
$pdf->Cell(0, 5, '','B', 1, 'C');
//-----------------------------------

$pdf->SetFont('Arial', 'U', 10);
$pdf->Cell(15,5,'Adresse:',0,0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(130,5,'B.P 549, Av.Abdelkarim elkhattab',0,0);
// $pdf->Image('fpdf/logofstg.png',null,null,10,15);

$pdf->Cell(140,5,'BP 549 en darija',0,1);
$pdf->Cell(15, 6, '', 0, 0);
$pdf->Cell(130,5,'Gueliz - Marrakech',0,1);
$pdf->Cell(15, 6, '', 0, 0);
$pdf->Cell(110,5,'Tel : +212 24 43 34',0,0);
$pdf->Cell(59,5,'Fax: +212 24 43 31',0,1);
$pdf->Cell(0, 1, '','B', 1, 'C');


//footer
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'Le present document n\'est delivre qu\'en un seul exemplaire.','', 1, 'C');
$pdf->Cell(0, 5, 'Il appartient a l\'etudiant d\'en faire des photocopies certifiees conformes.','', 1, 'C');

$pdf->Output();
?>