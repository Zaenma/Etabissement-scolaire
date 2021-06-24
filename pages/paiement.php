<?php include_once 'include/header.php' ?>

<h3 class="my-5 text-primary text-center">Gestions des paiements</h3>

<div class="row">
    <!-- Liste des classe -->
    <div class="col-2">
        <h5>Liste des classes</h5>
        <div id="" class="no-uicustom bg-info mb-2"></div>
        <?php foreach (toutesLigne("sections") as $classe) : ?>
            <a href="?p=paiement&pc=<?= $classe['identifiant'] ?>"><?= $classe['section'] ?> </a> <br> <br>
        <?php endforeach; ?>
    </div>
    <!-- Affiche les détails d'un paiement -->
    <div class="col-10">
        <!-- Si la variable pc (paiement de la classe) en GET existe et n'est pas vide  -->
        <?php if (isset($_GET['pc']) && !empty($_GET['pc'])) : ?>
            <?php $mensualite = uneLigne('sections', 'identifiant', $_GET['pc'])['montant_mensuel'] ?>
            <!-- Si la variable existe, n'est pas vide et la liste de des élèves n'est pas vide, 
        c'est dire que la fonction listeElevesParClasse renvoie quelque chose différent de NULL -->
            <?php if (listeElevesParClasse($_GET['pc']) != NULL) : ?>
                <div class="alert alert-info text-white alert-dismissible fade show alert-informatins" role="alert" id="alert-info">
                    <div id="">
                        <strong id="alert-montant">Hello... petite information ! Mensualité de cette classe : <span id="montant-mensuel" class="text-white"> <?= $mensualite ?> </span> FCFA </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr class="text-center">
                            <th colspan="1" class="">Elèves</th>
                            <th class="" colspan="12">Mois</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <!-- On parcour le tableau des mois pour afficher la liste des mois -->
                            <?php for ($i = 0; $i <= count(mois()); $i++) : ?>
                                <td><?= mois()[$i] ?></td>
                            <?php endfor; ?>
                        </tr>
                        <?php foreach (listeElevesParClasse($_GET['pc']) as $e) : ?>
                            <tr class="">

                                <!-- Lien permettant d'afficher la fiche descriptive d'un élève -->
                                <td> <a href="index.php?p=eleves&id=<?= $e['identifiant'] ?>"><?= $e['matricule'] ?></a></td>

                                <!-- cette élément est en display : none, il ne sera pas affiché sur la page -->
                                <span class="nombre_mois_payer"><?= nombreMoisPayer($e['identifiant']) ?></span>

                                <form action="fonctions/traitements.php" method="POST" class="formulaire-paiement">
                                    <!-- On affiche les cases à cochés identique selon le nombre de mois indiqués -->
                                    <?php for ($i = 0; $i < count(mois()); $i++) : ?>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <!-- Le nom de champs est $i + 1 et la valeur $i + 1 (l'index de la table commence par 0) -->
                                                    <input type="checkbox" class="form-check-input champs-paiement" name="<?= $i ?>" id="<?php mois()[$i + 1] ?>">
                                                </label>
                                            </div>
                                        </td>
                                    <?php endfor; ?>
                                    <td>
                                        <input class="text-white btn btn-primary" id="btn-ajout-paiement" name="btn-ajout-paiement" type="submit" value="Valider">
                                        <a href="index.php?p=recu&el=<?= $e['identifiant'] ?>" class="btn btn-info imprimer-recu-paiement" id="imprimer-recu-paiement-<?= $e['identifiant'] ?>">@</a>
                                    </td>
                                    <input type="hidden" name="eleve" value=<?= $e['identifiant'] ?>>
                                </form>
                            </tr>
                            <div id="recu-paiement<?= $e['identifiant'] ?>" role="" class="">
                                <?php foreach (iformationsPaiement($e['identifiant']) as $p) : ?>
                                    <div class="">
                                        <div class="d-flex justify-content-between card-header">
                                            <h4 class="text-primary">RECU N° TZZYY4372</h4>
                                            <b class="text-primary">Date de paiment : <?= (new DateTime($p['date_paiement']))->format('d/m/Y') ?> à <?= (new DateTime($p['date_paiement']))->format('H:i') ?></b>
                                        </div>
                                        <div id="" class="no-uicustom bg-info mb-2"></div>
                                        <h5>Reçu de : <?= $e['nom_e'] ?></h5>
                                        <h5>Matricule N° : <?= $e['matricule'] ?></h5>
                                        <p>
                                            <b>La somme de : <span id="somme-en-lettre"></span> <span id="somme-paye"><?= nombreMoisPayer($e['identifiant']) * $mensualite  ?></span> FCFA </b>
                                        </p>
                                        <p>
                                            <b><?= (nombreMoisPayer($e['identifiant']) > 1)  ? "Pour les mois suivants" : "Pour le mois suivant"; ?> :</b>

                                            <?php for ($i = 1; $i <= nombreMoisPayer($e['identifiant']); $i++) : ?>
                                                <b><?= mois()[$i] ?> <?= ($i == nombreMoisPayer($e['identifiant']) - 1 && $i <= nombreMoisPayer($e['identifiant']))  ? "et" : ","; ?> </b>
                                            <?php endfor; ?>

                                        </p>
                                        <div class="d-flex justify-content-end mr-5 mb-5">
                                            <h5>La Directrice</h5>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Si la liste de la classe choisi est vide, on affiche l'alerte suivant -->

            <?php else : ?>
                <div class="alert alert-warning text-white alert-dismissible fade show" role="alert">
                    <strong>Hello Directrice !</strong> La liste des élèves de cette classe est vide :)
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <!-- Si on n'a pas choisi une classe, on affiche l'alerte suivant -->
        <?php else : ?>
            <div class="alert alert-warning text-white alert-dismissible fade show" role="alert">
                <strong>Hello Directrice !</strong> Veillez choisir une classe pour voir les détails de paiement de chaque élève
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php include_once 'include/footer.php' ?>