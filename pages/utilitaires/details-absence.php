<!-- Si l'élève a beaucoup d'absences -->
<?php if ($existe > 1) : ?>
    <div class="card text-left">
        <div class="card-header">
            <h4>Liste de tous les absences</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom et Matricule</th>
                        <th>Date d'absence</th>
                        <th>Justifié</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($eleve as $e) :  ?>
                        <tr>
                            <td> <a href=""><?= $e['nom_e'] ?> | <?= $e['matricule'] ?></a> </td>
                            <td><?= (new \DateTime($e['date_debut']))->format('d/m/Y'); ?> de <?= (new \DateTime($e['date_debut']))->format('H:i'); ?> à <?= (new \DateTime($e['date_fin']))->format('H:i'); ?></td>
                            <td>
                                <?php if ($e['justifie'] == 0) : ?>
                                    <b class="text-warning">Non</b>
                                <?php else : ?>
                                    <b class="text-success">Oui</b>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="" class="btn btn-info">=</a>
                                <?php if ($e['justifie'] == 0) : ?>
                                    <a href="index.php?p=absences&j=<?= $e['identifiant'] ?>" onclick="afficheUnDetails(<?= $e['identifiant'] ?>)" id="lien" class="btn btn-warning">+</a>
                                <?php else : ?>
                                    <span class="btn btn-success">+</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach  ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Fin d'affichage de la liste des absences d'un élève en particulier -->
<?php elseif ($existe == 1) : ?>
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex jusftify-content-between">
                <h5> Détail de l'absence - <?= $eleve['nom_e'] ?> | <?= $eleve['matricule'] ?></h5>
            </div>
        </div>
        <div class="card-body">
            <!-- Si l'élève n'a pas eu d'absence -->
            <?php if ($existe == 0) : ?>
                <div class="alert alert-warning text-white alert-dismissible fade show" role="alert">
                    <strong>Coucou !</strong> L'élève <?= $eleve['nom_e'] ?> n'a pas encore eu d'absence
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php else : ?>
                <!-- Si l'élève a un seul absence -->
                <?php if ($eleve['justifie'] == 0) : ?>
                    <div class="alert alert-warning text-white alert-dismissible fade show" role="alert">
                        <strong>Coucou !</strong> L'absence n'est pas encore justifié !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <h4 class="card-title mb-5">Le <?= (new \DateTime($eleve['date_debut']))->format('d/m/Y'); ?> de <?= (new \DateTime($eleve['date_debut']))->format('i:H'); ?> à <?= (new \DateTime($eleve['date_fin']))->format('i:H'); ?></h4>
                    <div class="row">
                        <div class="col-4">
                            <img src="static/fichiers/defaut.png" class="img-fluid" alt="" srcset="">
                        </div>
                        <div class="col-8">
                            <p class="card-text text-lg">
                                Nom de l'élève: <b><?= $eleve['nom_e'] ?></b> <br>
                                Section : <b><?= $eleve['section'] ?></b> <br>
                                Matiere : <b><?= $eleve['nom'] ?></b> <br>
                            </p>
                        </div>
                    </div>
                    <h5 class="by-5"> <b> Commentaire de l'absence </b></h5>
                    <p>
                        <?= $eleve['commentaire_absence'] ?>
                    </p>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($existe != 0) : ?>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="" class="btn btn-secondary">Contacter ses parents</a>
                        <?php if ($eleve['justifie'] == 0) : ?>
                            <a href="index.php?p=modifications&ja=<?= $eleve['identifiant'] ?>" class="btn btn-primary">Justifier</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php else : ?>
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex jusftify-content-between">
                <h5> Détail de l'absence - <?= $eleve['nom_e'] ?> | <?= $eleve['matricule'] ?></h5>
            </div>
        </div>
        <div class="card-body">
            <!-- Si l'élève n'a pas eu d'absence -->
            <?php if ($existe == 0) : ?>
                <div class="alert alert-warning text-white alert-dismissible fade show" role="alert">
                    <strong>Coucou !</strong> L'élève <?= $eleve['nom_e'] ?> n'a pas encore eu d'absence
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php else : ?>
                <!-- Si l'élève a un seul absence -->
                <?php if ($eleve['justifie'] == 0) : ?>
                    <div class="alert alert-warning text-white alert-dismissible fade show" role="alert">
                        <strong>Coucou !</strong> L'absence n'est pas encore justifié !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <h4 class="card-title mb-5">Le <?= (new \DateTime($eleve['date_debut']))->format('d/m/Y'); ?> de <?= (new \DateTime($eleve['date_debut']))->format('i:H'); ?> à <?= (new \DateTime($eleve['date_fin']))->format('i:H'); ?></h4>
                    <div class="row">
                        <div class="col-4">
                            <img src="static/fichiers/defaut.png" class="img-fluid" alt="" srcset="">
                        </div>
                        <div class="col-8">
                            <p class="card-text text-lg">
                                Nom de l'élève: <b><?= $eleve['nom_e'] ?></b> <br>
                                Section : <b><?= $eleve['section'] ?></b> <br>
                                Matiere : <b><?= $eleve['nom'] ?></b> <br>
                            </p>
                        </div>
                    </div>
                    <h5 class="by-5"> <b> Commentaire de l'absence </b></h5>
                    <p>
                        <?= $eleve['commentaire_absence'] ?>
                    </p>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($existe != 0) : ?>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="" class="btn btn-secondary">Contacter ses parents</a>
                        <?php if ($eleve['justifie'] == 0) : ?>
                            <a href="index.php?p=modifications&ja=<?= $eleve['identifiant'] ?>" class="btn btn-primary">Justifier</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<!-- Fin de la condition de vérification du paramètre "j" en GET -->