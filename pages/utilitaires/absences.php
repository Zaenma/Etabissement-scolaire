<?php if ($nb_absence != 0) : ?>
    <table class="table table-striped table-inverse table-rsponsive">
        <thead class="thead-inverse">
            <tr>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($absences as $a) : ?>
                <tr>
                    <td> <a href="index.php?p=eleves&id=<?= $a['identifiant'] ?>"><?= $a['matricule'] ?></a> </td>
                    <td><?= $a['nom_e'] ?></td>
                    <td class="d-flex justify-content-between">
                        <a href="" confirm="confirm('Voulez vous supprimer la section <?= $classe['identifiant'] ?> ?')" class="btn btn-danger">-</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php else : ?>
    <div class="alert alert-info text-white alert-dismissible fade show" role="alert">
        <strong>Coucou !</strong> Pas d'absences pour cette section !
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>