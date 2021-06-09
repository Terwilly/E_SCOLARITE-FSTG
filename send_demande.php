<?php 
session_start();
include_once "connect.php";
include_once "partials/functions.php";
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
$sqlquery = 'SELECT count(*) as total FROM demande WHERE cne=:cne AND type_document=:type_document AND annee_sco_demande=:annee_sco_demande';

$statementes = $db->prepare($sqlquery);
$statementes->execute([':cne'=>$cne,':type_document'=>$typedocument,':annee_sco_demande'=>$andemande]);
$count = $statementes->fetch();

if($count['total']<3){
    $sql = 'INSERT INTO demande(nom,prenom,cne,filliere,sem_demande,type_document,date_demande,annee_sco_demande) VALUES(:nom,:prenom,:cne,:filliere,:sem_demande,:type_document,sysdate(),:annee_sco_demande)';
    $statement = $db->prepare($sql);
        if ($statement->execute([':nom' => $nom, ':prenom' => $prenom, ':cne' => $cne, ':filliere' => $filliere,':sem_demande'=>$semestre, ':type_document' => $typedocument, ':annee_sco_demande' => $andemande])){
    $_SESSION['send'] = "Votre demande a bien ete envoye";
    header("Location: affichage_list_demande.php");
    }   
}
else
{
$_SESSION['nosend'] = "Votre demande n'est pas abouti ";
header("Location: affichage_list_demande.php");   
}
?>