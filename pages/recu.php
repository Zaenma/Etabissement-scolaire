<?php include_once 'include/header.php' ?>
<div class="row">
    <!-- Affiche les détails d'un paiement -->
    <div class="col-10">
        <?php
        $e = uneLigne('eleves', 'identifiant', $_GET['el']);
        $mensualite = uneLigne('sections', 'identifiant', $e['section_id'])['montant_mensuel']
        ?>
        <div id="recu-paiement" role="" class="">
            <?php foreach (iformationsPaiement($_GET['el']) as $p) : ?>
                <div class="">
                    <div class="d-flex justify-content-between card-header">
                        <h4 class="text-primary">RECU N° TZZYY4372</h4>
                        <b class="text-primary">Date de paiment : <?= (new DateTime($p['date_paiement']))->format('d/m/Y') ?> à <?= (new DateTime($p['date_paiement']))->format('H:i') ?></b>
                    </div>
                    <div id="" class="no-uicustom bg-info mb-2"></div>
                    <h5>Reçu de : <?= $e['nom_e'] ?></h5>
                    <h5>Matricule N° : <?= $e['matricule'] ?></h5>
                    <p>
                        <b>La somme de : <span id="somme-en-lettre"></span> <span id="somme-paye"><?= $p['nombre_mois'] * $mensualite  ?></span> FCFA </b>
                    </p>
                    <p>
                        <b><?= ($p['nombre_mois'] > 1)  ? "Pour les mois suivants" : "Pour le mois suivant"; ?> :</b>
                        <?php for ($i = 1; $i <= $p['nombre_mois']; $i++) : ?>
                            <b><?= mois()[$i] ?> <?= ($i == $p['nombre_mois'] - 1 && $i <= $p['nombre_mois'])  ? "et" : ","; ?> </b>
                        <?php endfor; ?>
                    </p>
                    <div class="d-flex justify-content-end mr-5 mb-5">
                        <h5>La Directrice</h5>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Si la liste de la classe choisi est vide, on affiche l'alerte suivant -->
        <!-- Si on n'a pas choisi une classe, on affiche l'alerte suivant -->
    </div>
</div>
<?php include_once 'include/footer.php' ?>