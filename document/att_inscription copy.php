<?php
session_start();
include_once "../connect.php";
include_once '../partials/functions.php';
if(!isset($_SESSION["identifiant"])){
    header("Location:../index.php");
}
$reponse = $db->query('SELECT * FROM etap');
while ($donnees = $reponse->fetch()) {
$lastname_etap= $donnees['lib_nom_pat_ind'];
$firstname_etap= $donnees['lib_pr1_ind'];
$apogee_etap = $donnees['cod_etu'];
$cne_etap = $donnees['cod_nne_ind'];
$carteId_etap = $donnees['cin_ind'];
$cod_sex_etap =$donnees['cod_sex_etu'];
$date_nai_etap =  $donnees['date_nai_ind'];
$lieuNai_etap =$donnees['lib_vil_nai_etu'];
$diplome_etap = $donnees['cod_etp'];
$annee_etap = $donnees['lib_dip'];
$annee_anu_etap = $donnees['cod_anu'];
}

$reponse->closeCursor();

$sql ='SELECT * FROM demande WHERE cne=:cne';
$statement = $db->prepare($sql);
$statement->execute([':cne'=>$cne_etap]);
while($demandes = $statement->fetch()){
    $cne_dem =  $demandes['cne'];
    $annee_sco_dem=$demandes['annee_sco_demande'];
    
    
}

$lastname =strtoupper($lastname_etap);
$firstname = strtoupper($firstname_etap);
$name = $lastname." ".$firstname;
$carteId = strtoupper($carteId_etap);
if($cod_sex_etap=='M'){
$cod_sex = "Monsieur";
}
else{
$cod_sex ="Mlle/Mme" ;
}
$cne = strtoupper($cne_dem);
$dateNai = dateToFrench("$date_nai_etap","l j F Y");
$lieuNai =$lieuNai_etap;
$annee_sco = $annee_sco_dem;
$diplome =$diplome_etap;
$annee = $annee_etap;
$sysdate = date("Y/m/d");
$apogee = $apogee_etap;
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
$pdf->Cell(0, 10, 'ATTESTATION D\'INSCRIPTION', '', 1, 'C');
// Saut de ligne
$pdf->Ln(15);

$pdf->SetFont('Arial', '', 14);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(10, 6, utf8_decode('Le Doyen de la Faculté des Sciences et Techniques de Marrakech atteste'), '', 1, 1);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(10, 6, utf8_decode('que L\'étudiant :'), 0, 1);
$pdf->Ln(6);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(22, 6, $cod_sex, 0, 0);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 6, $name , 0, 1);
$pdf->Ln(6);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(89, 6, utf8_decode('Numéro de la carte d\'identité nationale : '), 0, 0);
$pdf->Cell(0, 6, $carteId , 0, 1);
$pdf->Ln(6);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(89, 6, utf8_decode('Code Nationale de l\'étudiant : '), 0, 0);
$pdf->Cell(0, 6, $cne , 0, 1);
$pdf->Ln(6);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(89, 6,utf8_decode("ne le $dateNai a $lieuNai "), 0, 0);
$pdf->Ln(12);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(150, 6,utf8_decode('est regulièrement inscrit à la Faculté des Sciences et Techniques (FSTG)'), 0, 1);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(150, 6, utf8_decode('Guéliz-Marrakech pour l\'année universitaire '). $annee_sco.'.', 0, 1);
$pdf->Ln(6);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->SetFont('Arial', 'BU', 14);
$pdf->Cell(21, 6, 'Diplome:', 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(0, 6, $diplome , 0, 1);
$pdf->Ln(6);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->SetFont('Arial', 'BU', 14);
$pdf->Cell(21, 6, utf8_decode('Année:'), 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(0, 6, $annee , 0, 1);
$pdf->Ln(12);
$pdf->Cell(100, 6, '', 0, 0);
$pdf->Cell(21, 6, utf8_decode('Fait à Marrakech, le '). $sysdate, 0, 0);
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
$pdf->Cell(130,5,utf8_decode('Guéliz - Marrakech'),0,1);
$pdf->Cell(15, 6, '', 0, 0);
$pdf->Cell(110,5,utf8_decode('Tél : +212 24 43 34'),0,0);
$pdf->Cell(59,5,'Fax: +212 24 43 31',0,1);
$pdf->Cell(0, 1, '','B', 1, 'C');


//footer
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, utf8_decode('Le présent document n\'est delivré qu\'en un seul exemplaire.'),'', 1, 'C');
$pdf->Cell(0, 5, utf8_decode('Il appartient à l\'étudiant d\'en faire des photocopies certifiées conformes.'),'', 1, 'C');

$pdf->Output();
?>