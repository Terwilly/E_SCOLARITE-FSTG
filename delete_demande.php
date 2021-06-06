<?php 
session_start();
include_once "connect.php";
if(!isset($_SESSION["user"])){
    header("Location:index.php");
}
$id =$_GET['id'];
$sql = 'DELETE FROM demande WHERE id=:id';
$statement = $db->prepare($sql);
if ($statement->execute([':id'=> $id])){
$_SESSION['delete'] ="Delete avec success";
header("Location: affichage_list_demande.php");
}
?>