<?php 
session_start();
include_once "connect.php";
require 'partials/functions.php';
if(!isset($_SESSION["user"])){
    header("Location:index.php");
}

$reponse = $db->prepare("SELECT * FROM etap WHERE cod_nne_ind=?");
$reponse->execute(array($_SESSION["cne"]));
while ($donnees = $reponse->fetch()) {
$lastname= $donnees['lib_nom_pat_ind'];
$firstname = $donnees['lib_pr1_ind'];
}
$reponse->closeCursor();

if(isset($_POST['login'])){
$nom = $lastname;
$prenom = $firstname;
$cne = $_POST['cne'];
$filliere = $_POST['filliere'];
$typedocument=$_POST['typedocument'];
$semestre = $_POST['semestre'];
$andemande = $_POST['andemande'];
}

$sql = 'UPDATE demande SET nom=:nom, prenom=:prenom, cne=:cne, filliere=:filliere, sem_demande=:sem_demande, type_document=:type_document,date_demande=SYSDATE(),annee_sco_demande=:annee_sco_demande WHERE id=:id';
$statement = $db->prepare($sql);

if ($statement->execute([':nom' => $nom, ':prenom' => $prenom, ':cne' => $cne, ':filliere' => $filliere,':sem_demande'=>
$semestre, ':type_document' => $typedocument, ':annee_sco_demande' => $andemande,':id'=> $id])){
$_SESSION['update']= "Modification avec success";
header("Location: affichage_list_demande.php");
}
?>