<?php
session_start();
include_once "connect.php";
if(!isset($_SESSION["identifiant"])){
    header("Location:index.php");
}
?>
<?php
include "connect.php";
require_once 'partials/functions.php';
$sql = "SELECT * from demande ORDER BY date_demande DESC";
$statement = $db->prepare($sql);
$statement->execute();
$demandes = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<?php
$title = "Identification";
require_once 'partials/header.php';?>
<main>
    <header>
        <h1 class="header">E-SCOLARITE FSTG
            <?php echo annee_scolaire_actuelle();?>
        </h1>
        <!-- <div class="text-center">
            <a class="btn btn-danger mt-2" href="logout.php">Déconnecter</a>
        </div> -->
        <div>
            <nav class="navbar container navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarTogglerDemo01">
                    <select class="form" name="" id="">
                        <option value="">Select</option>
                        <option value="">7 Jours avant</option>
                        <option value="">15 Jours avant</option>
                        <option value="">ce Mois avant</option>
                    </select>
                    <form class="form-inline justify-content-start d-flex mr-auto mt-2 mt-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search"
                            aria-label="Search">&nbsp;&nbsp;
                        <a class="btn form-inline btn-outline-success my-2 my-sm-0" type="submit">Search</a>
                    </form>
                    <div class="form-inline my-2 my-lg-0">
                        <a class="btn btn-danger" href="logout.php" type="submit">Déconnecter</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <div class="table-responsive container">
        <table class="table bg-light table-stripped caption-top">
            <caption class=" text-center text-light display-5 ">Liste de demandes de Documents
            </caption>
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">CNE</th>
                    <th scope="col">Fillière</th>
                    <th scope="col">Type Document</th>
                    <th scope="col">Semestre demande</th>
                    <th scope="col">Année de demande</th>
                    <th scope="col">Date de demande</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($demandes as $demande): ?>
                <tr>
                    <td><?= $demande->nom?></td>
                    <td><?= $demande->prenom?></td>
                    <td><?= $demande->cne; ?></td>
                    <td><?= $demande->filliere; ?></td>
                    <td><?= $demande->type_document; ?></td>
                    <td><?= $demande->sem_demande; ?></td>
                    <td><?= $demande->annee_sco_demande; ?></td>
                    <td><?= dateToFrench($demande->date_demande, "j F Y"); ?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Choix de Statut
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Envoyer</a>
                                <a class="dropdown-item" href="#">Traitement en cours</a>
                                <a class="dropdown-item" href="#">Pret</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));"
                            class="text-danger" href="delete_demande_resp.php?id=<?= $demande->id ?>"><i
                                class="fas fa-1x fa-minus-circle"></i></a>
                        &nbsp;
                        <a class="text-info" target="_blank" href=" <?php
                        if($demande->type_document=="inscription"){
                        echo "document/att_inscription.php?cnedemande=$demande->cne ";}
                        else if($demande->type_document=="scolarite"){ echo "document/att_scolarite.php?cnedemande=$demande->cne" ;} else
                            if($demande->type_document=="releves"){
                            echo "document/releves.php?cnedemande=$demande->cne";}
                            ?>"><i class="fas fa-1x fa-print"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</main>


<?php require_once 'partials/footer.php';?>