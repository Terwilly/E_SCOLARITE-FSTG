<?php else: ?>
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
        <a onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));" class="text-danger"
            href="delete_demande_resp.php?id=<?= $demande->id ?>"><i class="fas fa-1x fa-minus-circle"></i></a>
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