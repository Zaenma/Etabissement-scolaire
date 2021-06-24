<?php

use Calendrier\Evenement;

require_once('vendor/autoload.php');

$pdo = co_db();

$evenements = new Evenement($pdo);

$evenement = $evenements->evenements();

$titre = "Evènements";
?>


<?php include_once 'include/header.php' ?>
<h5>Liste des classes</h5>
<div id="" class="no-uicustom bg-info mb-5"></div>
<div class="row">
    <section class="col-md-9">
        <?php foreach ($evenement as $event) : ?>
            <div class="row">
                <div class="col-md-3 col-10"><span><a href="index.php?p=edite-evenement&id-evenement=<?= $event->getId(); ?>"><?= $event->getNom(); ?></a> </span></div>
                <div class="col-md-2 col-10"> <span> <?= $event->getType_evenement(); ?></span></div>
                <div class="col-md-3 col-10"><span><?= $event->getDate_debut()->format('d/m/Y'); ?> à <?= $event->getDate_debut()->format('H:i'); ?></span></div>
                <div class="col-md-3 col-10"><span><?= $event->getDate_fin()->format('d/m/Y'); ?> à <?= $event->getDate_fin()->format('H:i'); ?></span></div>
                <div class="col-md-1 col-2"><span class="btn <?= $event->getType_evenement() == 1 ? "btn-success" : "btn-info"; ?> "><a href="index.php?p=edite-evenement&id-evenement=<?= $event->getId(); ?>">✔️</a></span></div>
            </div>
            <hr>
        <?php endforeach; ?>
    </section>
    <section class="col-md-3 text-center">
        <h5 class="text-info">Actions</h5>
        <p><a href="index.php?p=ajout-evenement">Ajouter un évènement</a></p>
    </section>


</div>

<?php include_once 'include/footer.php' ?>