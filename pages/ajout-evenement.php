<?php

use App\Valide;

ob_start();

if (empty($_SESSION['madame-Diop']))
    header('Location:../');

// $sessionencours = selectionSessionencours();
/***
 * Connexion à la base de donnée, défini dans Admin/Librairie/fonctions.php
 */
$pdo = co_db();
/**
 * Les classes du calendrier 
 * 
 */
// require_once('source/Calendrier/Evenement.php');
require_once('vendor/autoload.php');
$erreurs = [];
$donnees = [

    'date_debut' => $_GET['date'] ?? NULL,
    'date_fin' => $_GET['date'] ?? NULL
];

$valide = new Valide($donnees);
$valide->validee('date_debut', 'date_valide');
$valide->validee('date_fin', 'date_valide');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $donnees = $_POST;
    $evenementValide = new Calendrier\EvenementValide();
    $erreurs = $evenementValide->validees($_POST);

    if (empty($erreurs)) {

        $evenement = new \Calendrier\Events();
        $evenement->setNom($donnees['titre']);
        $evenement->setType_evenement($donnees['type-evenement']);
        $evenement->setDescription($donnees['description']);
        $evenement->setDate_debut(DateTime::createFromFormat('Y-m-d H:i', $donnees['date_debut'] . ' ' . $donnees['heure_debut'])->format('Y-m-d H:i:s'));
        $evenement->setDate_fin(DateTime::createFromFormat('Y-m-d H:i', $donnees['date_fin'] . ' ' . $donnees['heure_fin'])->format('Y-m-d H:i:s'));
        $evenements = new \Calendrier\Evenement($pdo);
        $evenements->creer_evenement($evenement);
        header('location:index.php?p=dashbord&ms=1');
        exit();
    }
}
?>
<?php

/**
 * Inclusion de la classe Evenement 
 */
$evenements = new Calendrier\Evenement($pdo);

?>


<?php include_once 'include/header.php' ?>

<div class="breadcrumb-holder">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Acceuil</a></li>
        <li class="breadcrumb-item active"></li>Ajout d'un nouvel évènement</li>
    </ul>
</div>
<div class="row">
    <div class="col-md-9">
        <section class="container-fluid">
            <?php if (!empty($erreurs)) : ?>
                <div class="alert alert-danger">
                    Merci de corriger vos erreurs
                </div>
            <?php endif; ?>
            <div class="d-flex flex-row align-items-center justify-content-between">
                <h1>Ajout d'un nouvel évenement</h1>
            </div>
            <div id="" class="no-uicustom bg-info mb-5"></div>
            <form action="" method="POST" class="form">
                <?php include 'event-form.php' ?>
                <button class="btn btn-primary mb-5">Ajouter l'évènement</button>
            </form>

        </section>
    </div>
    <div class="col-md-3">
        <h4 class="text-info">Liste des évènements</h4>
        <?php foreach (toutesLigne("evenements") as $ev) : ?>
            <a href="index.php?p=edite-evenement&id-evenement=<?= $ev['Id'] ?>"><?= $ev['Nom'] ?> </a> <br> <br>
        <?php endforeach; ?>
    </div>
</div>


<?php include_once 'include/footer.php' ?>