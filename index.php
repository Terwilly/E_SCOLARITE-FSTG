<?php
session_start();
include "connect.php";
include_once 'partials/functions.php';
if(isset($_POST["login"])){
    if($_POST["cne"]=="" or $_POST["datenai"]==""){
        echo '<div class="alert alert-warning text-center">Veuillez remplir tous les champs pour accéder à votre compte.
        </div>';
    }else{
      $cne = $_POST["cne"];
      $datenai =  $_POST["datenai"] ;
        $query = $db->prepare('SELECT * FROM etap WHERE cod_nne_ind=? AND date_nai_ind=?');
        $query->execute(array($cne,$datenai));
        $control = $query->fetch(PDO::FETCH_OBJ);
               
        if(($_POST['cne']== isset($control->cod_nne_ind) && $_POST['datenai']==isset($control->date_nai_ind)) && $control>0)
        {
            $_SESSION["user"] = $control->lib_nom_pat_ind;
            $_SESSION['cne']= $control-> cod_nne_ind;
            header("Location:fillieres.php");
        }
        else{
            echo '<div class="alert alert-warning text-center">CNE or date de Naissance incorrect
            </div>';
        }
    }   
}
?>
<?php
$title = "Identification";
 require_once 'partials/header.php';?>
<main>
    <header>
        <h1 class="header">E-SCOLARITE FSTG <?php echo annee_scolaire_actuelle();?></h1>
    </header>

    <section class="identification">
        <div class="img">
            <img src="./static/logofstg.png" title=" Logo FSTG" alt=" Logo FSTG" srcset="">
        </div>
        <div>
            <h2>Identification Etudiant</h2>
        </div>
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="text" name="cne" autocomplete="off" class="form-control" id="floatingInput"
                    placeholder="CNE ou CODE MASSAR">
                <label for="floatingInput">CNE ou CODE MASSAR</label>
            </div>
            <div class="form-floating">
                <input type="date" name="datenai" autocomplete="off" class="form-control" id="floatingPassword">
                <label for="floatingPassword">Date de Naissance</label>
            </div>
            <div class="btn-sumit">
                <button type="submit" name="login" class=" btn btn-primary btn-lg btn-block">Valider</button>
            </div>
        </form>
        <p>*Vous Trouverez votre Numéro Apogée aprés votre identification</p>
    </section>

</main>

<?php require_once 'partials/footer.php';?>