<?php
session_start();
include_once "connect.php";
include_once 'partials/functions.php';
if(!isset($_SESSION["user"])){
    header("Location:index.php");
}
?>

<?php
$title = "Formulaire demande";
require_once 'partials/header.php';?>
<main>
    <header>
        <h1 class="header">E-SCOLARITE FSTG <?php echo annee_scolaire_actuelle();?></h1>
        <?php require_once 'partials/nav.php' ?>
        <div class="text-center">
            <h3>Bienvenue <?=$_SESSION["user"] ?></h3>
            <a class="btn btn-danger mb-2" href="logout.php">Déconnecter</a>
        </div>
    </header>
    <?php
        $reponse = $db->prepare('SELECT * FROM etap WHERE cod_nne_ind=?');
        $reponse->execute(array($_SESSION['cne']));
        while ($donnees = $reponse->fetch()) {
            $codetu= $donnees['cod_etu'];
            $codnneind = $donnees['cod_nne_ind'];
            $datnaiind = $donnees['date_nai_ind'];
            $codetp = $donnees['cod_etp'];
            $codeanu = $donnees['cod_anu'];
        }
        $reponse->closeCursor();
    ?>
    <section>
        <div class="box">
            <div class="card p-3 bg-info">
                <form action="send_demande.php" method="post">
                    <div class="form-group">
                        <label for="">Numéro Apogée</label>
                        <input class="form-control" name="numapogee" required type="text"
                            value="<?php echo "$codetu" ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Numéro CNE</label>
                        <input class="form-control" name="cne" type="text" readonly required
                            value="<?php echo "$codnneind" ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Date de naissance</label>
                        <input class="form-control" name="datenai" required type="text"
                            value="<?php echo dateToFrench($datnaiind, "j F Y")?>" disabled>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select required name="filliere" class="form-select" required name="filliere"
                                    onchange="changeStatus();" id="list" aria-label="Floating label select example">
                                    <option selected>Dans quelle fillière êtes-vous inscrit?</option>
                                    <?php                
                                $answer = "select cod_etp from etap where cod_etu=?";
                                $statement = $db->prepare($answer);
                                $statement->execute(array($codetu)); 
                                
                                while ($donnees = $statement->fetch())
                                {
                                $val=$donnees['cod_etp'];
                                echo "<option id=\"$val\" value=\"$val\">".$donnees['cod_etp']."</option>";
                                }
                                $statement->closeCursor();
                                ?>
                                </select>
                                <label for="floatingSelectGrid">Sélectionner votre Fillière</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" required name="typedocument" onchange="changeStatusYear()"
                                    id="stud" aria-label="Floating label select example">
                                    <option>Quel document voulez vous?</option>
                                    <option value="inscription">Attestation d'inscription</option>
                                    <option value="scolarite">Attestation de Scolarité</option>
                                    <option value="releves">Rélevés de notes</option>
                                </select>
                                <label for="floatingSelectGrid">Sélectionner votre Document</label>
                            </div>
                        </div>
                        <div class="mt-4 row">
                            <div class="col-md-6">
                                <div id="anun" class="cacheSem p-3">
                                    <h6>Choisir le Semestre</h6>
                                    <input required type="radio" name="semestre" value="Semestre 1" id="sem1">
                                    <label for="sem1">Semestre 1</label><br>
                                    <input required type="radio" name="semestre" value="Semestre 2" id="sem2">
                                    <label for="sem1">Semestre 2</label>
                                </div>
                                <div id="andeux" class="cacheSem p-3">
                                    <h6>Choisir le Semestre</h6>
                                    <input required type="radio" name="semestre" value="Semestre 3" id="sem3">
                                    <label for="sem3">Semestre 3</label><br>
                                    <input required type="radio" name="semestre" value="Semestre 4" id="sem4">
                                    <label for="sem4">Semestre 4</label>
                                </div>
                                <div id="antrois" class="cacheSem p-3">
                                    <h6>Choisir le Semestre</h6>
                                    <input required type="radio" name="semestre" value="Semestre 5" id="sem5">
                                    <label for="sem5">Semestre 5</label><br>
                                    <input required type="radio" name="semestre" value="Semestre 6" id="sem6">
                                    <label for="sem6">Semestre 6</label>
                                </div>
                                <h6 id="messageFilliere"></h6>
                            </div>
                            <div class="col-md-6">
                                <div id="dataReleve" style="display:none;" class=" data p-3">
                                    <h6>Choisir l'année</h6>
                                    <div>
                                        <!-- <input required type="radio" name="andemande" value="2017/2018" id="andemande">
                                    <label for="">2017/2018</label><br> -->
                                        <input required type="radio" name="andemande"
                                            value="<?php echo  les_annee_scolaire(3) ?>" id="">
                                        <label for=""> <?php echo  les_annee_scolaire(3)?></label>
                                    </div>
                                    <div>
                                        <input required type="radio" name="andemande"
                                            value="<?php echo  les_annee_scolaire(2) ?>" id="">
                                        <label for=""> <?php echo  les_annee_scolaire(2)?></label>
                                    </div>
                                    <div>
                                        <input required type="radio" name="andemande"
                                            value="<?php echo  les_annee_scolaire(1) ?>" id="">
                                        <label for=""> <?php echo  les_annee_scolaire(1) ?></label>
                                    </div>
                                    <div>
                                        <input required type="radio" name="andemande"
                                            value="<?php echo annee_scolaire_actuelle() ?>" id="">
                                        <label for=""> <?php echo annee_scolaire_actuelle() ?></label>
                                    </div>
                                </div>
                                <div id="dataInsc" style="display:none;" class="data p-3">
                                    <h6>Choisir l'année</h6>
                                    <div>
                                        <input required type="radio" name="andemande"
                                            value="<?php echo annee_scolaire_actuelle() ?>" id="">
                                        <label for=""> <?php echo annee_scolaire_actuelle() ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-5 mb-4">
                                <button type="submit" name="login" class="btn btn-success"> DEMANDER
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php require_once 'partials/footer.php';?>