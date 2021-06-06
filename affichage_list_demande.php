<?php 
session_start();
include_once "connect.php";
include_once 'partials/functions.php';
if(!isset($_SESSION["user"])){
    header("Location:index.php");
}
// iaffichage de la liste
$sql = "SELECT * from demande where cne = ? ORDER BY date_demande DESC";
$statement = $db->prepare($sql);
$statement->execute(array($_SESSION['cne']));
$demandes = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<!-- End affichage -->
<?php
$title = "Demande Envoye";
require_once 'partials/header.php';?>

<main>
    <header>
        <h1 class="header">E-SCOLARITE FSTG <?php echo annee_scolaire_actuelle();?>
        </h1>
        <?php require_once 'partials/nav.php' ?>
        <div class="text-center">
            <a class="btn btn-danger  mb-2 mt-2" href="logout.php">Déconnecter</a>
        </div>
    </header>
    <div class="table-responsive container">
        <table class="table bg-light table-striped table-hover caption-top">
            <caption class=" text-center text-light display-5 ">Ma liste de demande</caption>
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
                    <th scope="col"> Action </th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($demandes as $demande): ?>
                <tr>
                    <td><strong><?= $demande->nom?></strong></td>
                    <td><strong><?= $demande->prenom?></strong></td>
                    <td><?= $demande->cne; ?></td>
                    <td><?= $demande->filliere; ?></td>
                    <td><?= $demande->type_document; ?></td>
                    <td><?= $demande->sem_demande; ?></td>
                    <td><?= $demande->annee_sco_demande; ?></td>
                    <td><?= dateToFrench($demande->date_demande, "j F Y"); ?></td>
                    <td><strong><?= $demande->statut_demande; ?></strong> </td>
                    <td>
                        <a onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));"
                            class="text-danger" href="delete_demande.php?id=<?= $demande->id ?>"><i
                                class="fas fa-1x fa-minus-circle"></i></a>
                        &nbsp;
                        <a class="text-info" href="update_demande.php?id=<?= $demande->id ?>"><i
                                class="fas fa-edit"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="container float-right ">
        <button class="btn btn-primary"> <a href="fillieres.php">Faire une nouvelle demande</a> </button>
    </div>
    <br>
    <br>
</main>

<?php require_once 'partials/footer.php';?>