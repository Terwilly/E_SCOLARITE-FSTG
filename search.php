<?php
session_start();
include_once "connect.php";
include_once "partials/functions.php";
if(!isset($_SESSION["identifiant"])){
    header("Location:index.php");
}
?>

<table class="table table-bordered">
    <thead class="alert-info">
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
        <?php
        if(isset($_POST['search'])){
            $keyword = $_POST['keyword'];
            affiche($keyword);
            $query = db->prepare("SELECT * FROM demande WHERE nom LIKE '$keyword' or prenom LIKE '$keyword' or cne LIKE '$keyword'");
            $query->execute();
            affiche($query->fetch());

            exit();
            while($row=$query->fetch()){?>
        <tr>
            <td><?= $row['nom']?></td>
            <td><?= $row['prenom']?></td>
            <td><?= $row->cne; ?></td>
            <td><?= $row->filliere; ?></td>
            <td><?= $row->type_document; ?></td>
            <td><?= $row->sem_demande; ?></td>
            <td><?= $row->annee_sco_demande; ?></td>
            <td><?= dateToFrench($row->date_demande, "j F Y"); ?></td>
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
                <a onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));" class="text-danger"
                    href="delete_demande_resp.php?id=<?= $row->id ?>"><i class="fas fa-1x fa-minus-circle"></i></a>
                &nbsp;
                <a class="text-info" target="_blank" href=" <?php
                        if($row->type_document=="inscription"){
                        echo "document/att_inscription.php?cnedemande=$ro->cne ";}
                        else if($row->type_document=="scolarite"){ echo "document/att_scolarite.php?cnedemande=$demande->cne" ;} else
                            if($row->type_document=="releves"){
                            echo "document/releves.php?cnedemande=$row->cne";}
                            ?>"><i class="fas fa-1x fa-print"></i></a>
            </td>
        </tr>


        <?php

        }

        ?>
    </tbody>
</table>
<?php
}