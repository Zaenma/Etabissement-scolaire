<?php

ob_start();
/**
 * Les classes du calendrier
 */
require_once('vendor/autoload.php');
// require_once('source/Calendrier/Mois.php');
// require_once('source/Calendrier/Evenement.php');
/**
 * La connexion à la base de donnée
 */
$pdo = connectionDB();

/**
 * Inclusion de la classe Evenement 
 */
$evenements = new Calendrier\Evenement($pdo);
/**
 * La classe mois 
 */
$mois = new Calendrier\Mois($_GET['mois'] ?? NULL, $_GET['annee'] ?? NULL);

$dateJour = $mois->premierJourduMois();
$nombreSemaine = $mois->nombreJours();

// La date du jour 
$dateJour = $dateJour->format('N') === '1' ? $dateJour :   $mois->premierJourduMois()->modify('last monday');
// dte de fin de l'évenement 
$finEvenement = (clone $dateJour)->modify('+' . (6 + 7 * ($nombreSemaine - 1)) . 'days');
// L'ensemble des évenements 
$evenements = $evenements->recupereEvenementParJour($dateJour, $finEvenement);


$dossier = 'Pages/';

$pages = scandir($dossier);

if (isset($_GET['page']) && !empty($_GET['page'])) {
  if (in_array($_GET['page'] . '.php', $pages)) {
    $page = $_GET['page'];
  } else {
    $page = "error";
  }
} else {
  $page = "home";
}

?>
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Acceuil</a></li>
      <li class="breadcrumb-item active"></li>Calendrier des évèvements</li>
    </ul>
  </div>
</div>
<section class="container-fluid">
  <div class="calendrier">
    <header class="mt-4">
      <?php if (isset($_GET['message']) && $_GET['message'] === '1') : ?>
        <div class="alert alert-primary">
          <b>L'évènement a bie ffn été engrégistré ! ! !</b>
        </div>
      <?php endif; ?>
    </header>
    <div class="d-flex flex-row align-items-center justify-content-between">
      <h1><?= $mois->convertisseurMois(); ?></h1>
      <div class="">
        <a href="index.php?page=index&mois=<?= $mois->moisPrecendent()->mois; ?>&annee=<?= $mois->moisPrecendent()->annee; ?>" class="btn btn-primary">&lt;</a>
        <a href="index.php?page=index&mois=<?= $mois->moisSuivant()->mois; ?>&annee=<?= $mois->moisSuivant()->annee; ?>" class="btn btn-primary">&gt;</a>
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
                <a class="calendrier-jour" href="index.php?page=ajout-evenement&date=<?= $date->format('Y-m-d'); ?>"><?= $date->format('d'); ?></a>
                <?php foreach ($evenementDejour as $evenement) : ?>
                  <div class="calendrier-evenement">
                    <?= (new DateTime($evenement['date_debut']))->format('H:i') ?> - <a href="index.php?page=edite-evenement&id-evenement=<?= $evenement['Id'] ?>"><?= $evenement['Nom'] ?></a>
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
      <div class="bnt-ajout-evenement mb-5"> <a href="index.php?page=ajout-evenement">+</a> </div>
    </section>
  </div>
</section>