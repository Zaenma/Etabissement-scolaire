<?php include_once 'include/header.php' ?>

<section class="mt-5">
    <div class="row">
        <div class="col-12 col-md-4">
            <h4>Ajout des absences</h4>
            <div id="" class="no-uicustom bg-info mb-4"></div>
            <form class="" method="POST" action="fonctions/traitements.php">
                <div class="form-group">
                    <label for="default" class="control-label">La section</label>
                    <select class="form-control clid" name="id_section_absence" onChange="traitementAbsences(this.value);" required id="id_section_absence">
                        <option value="" selected>--------</option>
                        <?php foreach (toutesLigne("sections") as $classe) : ?>
                            <option value="<?= $classe['identifiant'] ?>"><?= $classe['section'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="control-label ">Nom de l'élève</label>
                    <select name="eleve-absence" class="form-control stid" id="id-eleve-absence" required="required" onChange="getresult(this.value);">
                    </select>
                </div>
                <!-- <div class="form-group">
                    <label for="" class="control-label">Appuyer la touche <span class="text-warning">Ctrl</span> pour selectionner plusieurs matières</label>
                    <select multiple name="matiere_id" class="form-control stid" id="matiere-absences" required="required" onChange="getresult(this.value);">
                    </select>
                </div> -->
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" class="form-control form-control-sm" name="date-absence" id="" required placeholder="">
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Heure de debut</label>
                            <input type="time" class="form-control form-control-sm" name="heure-debut-absence" required id="" placeholder="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Heure de fin</label>
                            <input type="time" class="form-control form-control-sm" name="heure-fin-absence" required id="" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Commentaire d'absence</label>
                    <textarea class="form-control" name="commentaire-absence" id="" rows="2" required></textarea>
                </div>
                <div class="form-group">
                    <div class="d-flex justify-content-end">
                        <input type="submit" id="btn-ajout-absence" name="btn-ajout-absence" class="btn btn-primary" value="Enregistrer">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <h4>Afficher la liste des absences par section</h4>
            <div id="" class="no-uicustom bg-info mb-4"></div>
            <?php if (nombre_ligne('absences', 'identifiant') != 0) : ?>
                <div class="mb-2" id="form-recherche">
                    <div class="d-flex justify-content-between">
                        <div class="form-group">
                            <label for="">La section</label>
                            <form action="" method="POST">
                                <select class="form-control clid" name="section_absence_id" onChange="afficheAbsences(this.value);" required id="section_absence_id">
                                    <option value="" selected>--------</option>
                                    <?php foreach (toutesLigne("sections") as $classe) : ?>
                                        <option value="<?= $classe['identifiant'] ?>"><?= $classe['section'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </form>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label ">Nom de l'élève</label>
                            <select name="eleve_absence" class="form-control stid" id="eleve_absence" required="required" onChange="afficheDetails(this.value);">
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Affichage de la liste des absence ou les details d'un absence -->
                <div id="affiche-absence"></div>
                <!-- Affichage du formualaire de justificantion -->
                <!-- <div id="formulaire-justifcation"></div> -->
            <?php endif; ?>
        </div>
    </div>
</section>

<script src="../static/js/script-ajax.js"></script>
<?php include_once 'include/footer.php' ?>