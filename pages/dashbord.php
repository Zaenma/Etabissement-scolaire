<?php

if (empty($_SESSION['madame-Diop']))
    header('Location:../');

$titre = "Dashbord";

include_once 'include/header.php';

?>
<section class="my-5">
    <h4>Dashbord</h4>
    <div id="" class="no-uicustom bg-info mb-4"></div>
    <div class="row">
        <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
            <?= card('Elèves', nombre_ligne('eleves', 'identifiant'), 'index.php?p=eleves', 'primary') ?>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
            <?= card('Enseignats', nombre_ligne('enseignants', 'identifiant'), 'index.php?p=enseignants', 'secondary') ?>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
            <?= card('Absences non justifiés', nombreAbsenceNonJustifie(), 'index.php?p=absences', 'warning') ?>
        </div>

        <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
            <?= card('Paiements', nombre_ligne('paiement', 'identifiant'), 'index.php?p=paiement', 'info') ?>
        </div>

        <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
            <?= card('Messages', 000, 'index.php?p=messages', 'dark') ?>
        </div>

        <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
            <?= card('Evènements', nombre_ligne('evenements', 'Id'), 'index.php?p=evenement', 'primary') ?>
        </div>

        <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
            <?= card('Classes', nombre_ligne('sections', 'identifiant'), 'index.php?p=classes', 'danger') ?>
        </div>

        <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
            <?= card('Enseignements', nombre_ligne('enseigner', 'section_id'), 'index.php?p=enseignement', 'success') ?>
        </div>
    </div>
</section>

<section>
    <h4>Calendrier pour la gestion des évènements</h4>
    <div id="" class="no-uicustom bg-info mb-4"></div>
    <?php
    require_once('calendrier/vendor/autoload.php');

    $pdo = co_db();

    $evenements = new Calendrier\Evenement($pdo);

    $mois = new Calendrier\Mois($_GET['mois'] ?? NULL, $_GET['annee'] ?? NULL);

    $dateJour = $mois->premierJourduMois();

    $nombreSemaine = $mois->nombreJours();

    // La date du jour
    $dateJour = $dateJour->format('N') === '1' ? $dateJour : $mois->premierJourduMois()->modify('last monday');
    // dte de fin de l'évenement
    $finEvenement = (clone $dateJour)->modify('+' . (6 + 7 * ($nombreSemaine - 1)) . 'days');
    // L'ensemble des évenements
    $evenements = $evenements->recupereEvenementParJour($dateJour, $finEvenement);

    ?>
    <section class="container-fluid">
        <div class="calendrier">
            <div class="d-flex flex-row align-items-center justify-content-between ml-3">
                <div class="text-primary">
                    <h3><?= $mois->convertisseurMois(); ?></h3>
                </div>
                <div class="">
                    <a href="index.php?p=dashbord&mois=<?= $mois->moisPrecendent()->mois; ?>&annee=<?= $mois->moisPrecendent()->annee; ?>" class="btn btn-primary changement-calandrier">&lt;</a>
                    <a href="index.php?p=dashbord&mois=<?= $mois->moisSuivant()->mois; ?>&annee=<?= $mois->moisSuivant()->annee; ?>" class="btn btn-primary changement-calandrier">&gt;</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="calendrier-table">
                    <?php for ($i = 0; $i < $nombreSemaine; $i++) : ?>
                        <tr>
                            <?php
                            foreach ($mois->t_jours as $k => $jour) :
                                $date = (clone $dateJour)->modify("+" . ($k + $i * 7) . "days");
                                $evenementDejour = $evenements[$date->format('Y-m-d')] ?? [];
                                $aujourdhui = date('Y-m-d') === $date->format('Y-m-d');
                            ?>
                                <td class="<?= $mois->estJourDuLeMois($date) ? '' : 'calendrier_autre_jour' ?> <?= $aujourdhui ? 'aujourdhui' : '' ?>">
                                    <?php if ($i === 0) : ?>
                                        <div class="calendrier-p-jour"><?= $jour; ?></div>
                                    <?php endif; ?>
                                    <a class="calendrier-jour" href="index.php?p=ajout-evenement&date=<?= $date->format('Y-m-d'); ?>"><?= $date->format('d'); ?></a>
                                    <?php foreach ($evenementDejour as $evenement) : ?>
                                        <div class="calendrier-evenement">
                                            <?= (new DateTime($evenement['date_debut']))->format('H:i') ?> - <a href="index.php?p=edite-evenement&id-evenement=<?= $evenement['Id'] ?>"><?= $evenement['Nom'] ?></a>
                                        </div>
                                    <?php endforeach; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endfor; ?>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <section>
                <div class="bnt-ajout-evenement mb-5"> <a href="index.php?p=ajout-evenement">+</a> </div>
            </section>
        </div>
    </section>
    </div>

</section>

<?php

if (!empty($_POST['btn'])) {

    extract($_POST);

    $nom = valide_champ_texte("Nom", 3, 10);
    $prenom = valide_champ_texte("prenom", 3, 10);
    $fils = valide_champ_texte("fils", 3, 10);
    $filles = valide_champ_texte("fille", 3, 10);
}


?>
</section>

<?php include_once 'include/footer.php' ?>