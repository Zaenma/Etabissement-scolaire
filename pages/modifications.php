<?php include_once 'include/header.php' ?>

<section>
    <div class="row">
        <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 col-12">
            <?php if (isset($_GET['ja']) and !empty($_GET['ja']) and is_numeric($_GET['ja'])) : ?>
                <h4 class="my-5 text-dark">Justification de l'absence de <span class="text-warning"><?= afficheAbsence($_GET['ja'])['nom_e'] ?></span> du <?= (new \DateTime(afficheAbsence($_GET['ja'])['date_debut']))->format('d/m/Y'); ?> de <?= (new \DateTime(afficheAbsence($_GET['ja'])['date_debut']))->format('i:H'); ?> à <?= (new \DateTime(afficheAbsence($_GET['ja'])['date_fin']))->format('i:H'); ?></h4>
                <div class="row">
                    <div class="col-sm-3"><img src="static/fichiers/defaut.png" alt="" srcset="" class="img-fluid"></div>
                    <div class="col-8">
                        <p> Nom de l'élève: <b><?= afficheAbsence($_GET['ja'])['nom_e'] ?></b> </p>
                        <p> Section : <b><?= afficheAbsence($_GET['ja'])['section'] ?></b></p>
                        <p> Matiere : <b><?= afficheAbsence($_GET['ja'])['nom'] ?></b></p> <br>
                        <p> Commentaire <br><b><?= afficheAbsence($_GET['ja'])['commentaire_absence'] ?></b></p>
                    </div>
                </div>
                <form action="fonctions/traitements.php" method="POST" class="mt-3">
                    <div class="form-group">
                        <label for="">Commentaire de justification</label>
                        <textarea class="form-control" name="justification" id="" rows="3" required><?= afficheAbsence($_GET['ja'])['commentaire_justifie'] ?></textarea>
                    </div>
                    <input type="hidden" name="id" value="<?= afficheAbsence($_GET['ja'])['identifiant'] ?>">
                    <div class="d-flex justify-content-end">
                        <?= button_submit("btn-justification-absence", "btn btn-primary", "Enregistrer") ?>
                    </div>
                </form>

            <?php endif; ?>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-12">

        </div>
    </div>
</section>


<?php include_once 'include/footer.php' ?>