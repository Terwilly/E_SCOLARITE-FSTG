<?php
session_start();
include "connect.php";
include_once "partials/functions.php";
if(isset($_POST["login"])){
    if($_POST["identifiant"]=="" or $_POST["password"]==""){
        echo '<center><div class="alert alert-warning">Veuillez remplir tous les champs pour acceder a votre compte
        </div></center>';
    }else{
        $identifiant =$_POST["identifiant"];
        $password = $_POST["password"];
        $query = $db->prepare('SELECT * FROM responsable WHERE identifiant=? AND password=?');
        $query->execute(array($identifiant,$password));
        $control = $query->fetch(PDO::FETCH_OBJ);
        if(($_POST['identifiant']== isset($control->identifiant) && $_POST['password']==isset($control->password)) && $control>0){
            $_SESSION["identifiant"] = $control->identifiant;
            header("Location:liste_demande.php");
        }
        echo '<center><div class="alert alert-warning">Identifiant or password incorrect.
            </div></center>';
    }
}
?>

<?php
$title = "Identification";
 require_once 'partials/header.php';?>


<main>
    <header>
        <h1 class="header">E-SCOLARITE FSTG <?php echo annee_scolaire_actuelle()?></h1>

    </header>
    <!-- <?php require_once 'partials/nav.php' ?> -->
    <section class="identification">
        <div class="img">
            <img src="./static/logofstg.png" alt="Logo FSTG" srcset="">
        </div>
        <div>
            <h2>Identification Responsable</h2>
        </div>
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="text" name="identifiant" autocomplete="off" class="form-control" id="floatingInput"
                    placeholder="Identifiant">
                <label for="floatingInput">Identifiant</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" autocomplete="off" class="form-control" id="floatingPassword"
                    placeholder="mot de passe">
                <label for="floatingPassword">Mot de passe</label>
            </div>
            <div class="btn-sumit">
                <button type="submit" name="login" class="btn btn-primary btn-lg btn-block">Se Connecter</button>
            </div>
        </form>
    </section>

</main>



<?php require_once 'partials/footer.php';?>