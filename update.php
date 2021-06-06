<?php
if(isset($_GET['id'])&& !empty($_GET['id'])){
    $id=$_GET['id'];
    $statut_demande="Prêt";
    include "connect.php";
    $update = 'UPDATE demande SET statut_demande=:statut_demande  WHERE id =:id';
    $statement = $db->prepare($update);
    if($statement->execute([':statut_demande' =>$statut_demande,':id'=> $id])){
        echo "with success";
    }
    else{
        echo "No data update";
    }
    header("Location: update.php");
    
}

?>