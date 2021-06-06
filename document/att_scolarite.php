<?php
$lastname ="SYLVAIN";
$firstname = strtoupper("Terwilly");
$name = $lastname." ".$firstname;

$carteId = "PP3332275";
$cne = "X000000662";
$dateNai ="06 Septembre 1995";
$lieuNai ="OUANAMINTE (HAITI) ";
$annee_sco = "2020/2021";
$diplome =" 3eme Annee LST SIR";
$annee = " Licence ST Systemes informations reparties";
$sysdate = date("Y/m/d");
$apogee = "1620959";

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
$pdf->Cell(130.5,5,'Université Cadi Ayyad',0,0);
$pdf->Cell(-1,5,$pdf->Image('../fpdf/logofstg.png',93,10,-250),0,0);
$pdf->Cell(60,5,'Université Cadi Ayyad-en darija',0,1,);
$pdf->Cell(130,5,'Faculte des Sciences et Techniques',0,0);
$pdf->Cell(59,5,'FSTG-en darija',0,1);
$pdf->Cell(130,5,'Gueliz - Marrakech',0,0);
$pdf->Cell(59,5,'Gueliz - Marrakech en darija',0,1);

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
$pdf->Cell(0, 10, 'ATTESTATION DE SCOLARITE', '', 1, 'C');
// Saut de ligne
$pdf->Ln(15);

$pdf->SetFont('Arial', '', 14);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(10, 6, 'Le Doyen de la Faculte des Sciences et Techniques de Marrakech atteste ', '', 1, 1);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(10, 6, 'que L\'etudiant :', 0, 1);
$pdf->Ln(6);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(22, 6, 'Monsieur ', 0, 0);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 6, $name , 0, 1);
$pdf->Ln(6);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(89, 6, 'Numero de la carte d\'identite nationale : ', 0, 0);
$pdf->Cell(0, 6, $carteId , 0, 1);
$pdf->Ln(6);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(89, 6, 'Code Nationale de l\'etudiant : ', 0, 0);
$pdf->Cell(0, 6, $cne , 0, 1);
$pdf->Ln(6);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(89, 6, "ne le $dateNai a $lieuNai ", 0, 0);
$pdf->Ln(12);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(150, 6, 'est regulierement inscrit a la Faculte des Sciences et Techniques (FSTG)', 0, 1);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(150, 6, 'Gueliz-Marrakech pour l\'annee universitaire '. $annee_sco.'.', 0, 1);
$pdf->Ln(6);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->SetFont('Arial', 'BU', 14);
$pdf->Cell(21, 6, 'Diplome:', 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(0, 6, $diplome , 0, 1);
$pdf->Ln(6);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->SetFont('Arial', 'BU', 14);
$pdf->Cell(21, 6, 'Annee:', 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(0, 6, $annee , 0, 1);
$pdf->Ln(12);
$pdf->Cell(100, 6, '', 0, 0);
$pdf->Cell(21, 6, 'Fait a Marrakech, le '. $sysdate, 0, 0);
$pdf->Ln(40);
$pdf->Cell(150, 6, '', 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(21, 2, '0'.$apogee,0, 1);
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