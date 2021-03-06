<?php
session_start();
include_once "connect.php";
include_once 'partials/functions.php';
if(!isset($_SESSION["identifiant"])){
    header("Location:index.php");
}
?>
<?php
include "connect.php";
require_once 'partials/functions.php';
$currentPage = (int)($_GET['page'] ?? 1);
if($currentPage <= 0){
    throw new Exception('Numero de page invalide');
}
$count =(int)$db->query("SELECT COUNT(id) FROM demande")->fetch(PDO::FETCH_NUM)[0];
$perPage = 12;
$pages = ceil($count / $perPage);
if($currentPage > $pages){
    throw new Exception('Cette page n\'existe pas');
}

$offset = $perPage * ($currentPage - 1);
$sql = "SELECT * from demande ORDER BY date_demande DESC LIMIT $perPage OFFSET $offset";
$statement = $db->prepare($sql);
$statement->execute();
$demandes = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<?php
$title = "Identification";
require_once 'partials/header.php';
?>
<main>
    <header>
        <h1 class="header">E-SCOLARITE FSTG
            <?php echo annee_scolaire_actuelle();?>
        </h1>
        <div>
            <nav class="navbar container navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarTogglerDemo01">
                    <form method="post" action="" class="form-inline justify-content-start d-flex mr-auto mt-2 mt-lg-0">
                        <input class="form-control mr-sm-2" type="text" name="keyword" placeholder="Recherche"
                            aria-label="Search">&nbsp;&nbsp;
                        <input type="submit" class="btn form-inline btn-outline-success my-2 my-sm-0" value="Filtrer"
                            name="recherche">
                    </form>
                    <div class="form-inline my-2 my-lg-0">
                        <a class="btn btn-danger" href="logout.php" type="submit">D??connecter</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <div class="text-center text-light display-5">Liste de demandes de Documents</div>
    <div class="container" align="right">
        <p class="text-white"> <b>Total: <span class="bg-danger display-7 p-2 rounded-circle  text-white"
                    id="total_records">
                    <?php $sql_total ="SELECT * FROM demande";
                    $smtm = $db->query($sql_total);
                    $total_records = $smtm->rowCount();
                    echo "$total_records";
                    ?> </span></b></p>
    </div>
    <div class="table-responsive container">
        <table class="table rounded bg-light table-striped table-hover caption-top">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Pr??nom</th>
                    <th scope="col">CNE</th>
                    <th scope="col">Filli??re</th>
                    <th scope="col">Type Document</th>
                    <th scope="col">Semestre demande</th>
                    <th scope="col">Ann??e de demande</th>
                    <th scope="col">Date de demande</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>

                <?php if(isset($_POST['recherche'])): ?>
                <?php
                $keyword = $_POST['keyword'];
                $query = $db->prepare("SELECT * FROM demande WHERE nom LIKE '$keyword' or prenom LIKE '$keyword' or cne LIKE '$keyword'");
                $query->execute(); 
                $rows = $query->fetchAll(PDO::FETCH_OBJ);
                ?>
                <?php foreach ($rows as $row) : ?>
                <tr>
                    <td><strong><?= $row->nom?></strong></td>
                    <td><strong><?= $row->prenom?></strong></td>
                    <td><?= $row->cne; ?></td>
                    <td><?= $row->filliere; ?></td>
                    <td><?= $row->type_document; ?></td>
                    <td><?= $row->sem_demande; ?></td>
                    <td><?= $row->annee_sco_demande; ?></td>
                    <td><?= dateToFrench($row->date_demande, "j F Y"); ?></td>
                    <td><strong><?= $row->statut_demande; ?></strong> </td>
                    <td>
                        <a onclick="return(confirm('Etes-vous s??r de vouloir supprimer cette entr??e?'));"
                            class="text-danger" href="delete_demande_resp.php?id=<?= $row->id ?>"><i
                                class="fas fa-1x fa-minus-circle"></i></a>
                        &nbsp;
                        <a class="text-info" onclick='updatedStatut("<?=$demande->id?>");' target="_blank" href=" <?php
                        if($row->type_document=="inscription"){
                        echo "document/att_inscription.php?cnedemande=$row->cne ";}
                        else if($row->type_document=="scolarite"){ echo "document/att_scolarite.php?cnedemande=$row->cne" ;} else
                            if($row->type_document=="releves"){
                            echo "document/releves.php?cnedemande=$row->cne";}
                            ?>"><i class="fas fa-1x fa-print"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
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
                        <a onclick="return(confirm('Etes-vous s??r de vouloir supprimer cette entr??e?'));"
                            class="text-danger" href="delete_demande_resp.php?id=<?= $demande->id ?>"><i
                                class="fas fa-1x fa-minus-circle"></i></a>
                        &nbsp;
                        <a class="text-info" onclick='updatedStatut("<?=$demande->id?>");' target="_blank" href=" <?php
                        if($demande->type_document=="inscription"){
                        echo "document/att_inscription.php?cnedemande=$demande->cne ";
                    }
                        else if($demande->type_document=="scolarite"){ echo "document/att_scolarite.php?cnedemande=$demande->cne" ;} else
                            if($demande->type_document=="releves"){
                            echo "document/releves.php?cnedemande=$demande->cne";}
                            ?>"><i class="fas fa-1x fa-print"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="container d-flex justify-content-between my-4">
        <?php if( $currentPage > 1 ): ?>
        <a href="liste_demande.php?page=<?=$currentPage-1?>" class="btn btn-primary ml-auto"> &laquo; Page
            Pr??cedente</a>
        <?php endif; ?>
        <?php if( $currentPage < $pages ): ?>
        <a href="liste_demande.php?page=<?=$currentPage+1?>" class="btn btn-primary"> Page Suivante
            &raquo;</a>
        <?php endif; ?>
    </div>

</main>
<script>
function updatedStatut(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            console.log("Votre document est en cours de traitement");
        }
    };
    xmlhttp.open("GET", "update.php?id=" + id, true);
    xmlhttp.send();
}
</script>


<?php require_once 'partials/footer.php';?>