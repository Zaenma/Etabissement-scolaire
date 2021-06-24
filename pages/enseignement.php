<?php include_once 'include/header.php' ?>

<h4 class="mt-3">Gestion des enseignements</h4>
<div id="" class="no-uicustom bg-info mb-5"></div>

<!-- Formulaire d'enregistrements -->
<div class="row">
    <!-- col-md-3 -->
    <div class="col-md-4">
        <h4>Ajout des matières</h4>
        <form action="fonctions/traitements.php" method="POST">
            <?= input('text', 'matiere', "Libellé de la matière") ?>
            <div class="d-flex justify-content-end">
                <?= input('submit', 'btn-ajout-matiere', '', 'btn btn-primary px-5', "Ajouter") ?>
            </div>
        </form>
    </div>
    <!-- Simple pop-up dialog box, containing a form -->

    <div class="col-sm-4">
        <h4>Ajout d'une section</h4>
        <form action="fonctions/traitements.php" method="POST">

            <?= input('text', 'section', "Nom de la section") ?>
            <?= input('number', 'montant_inscription', "Montant d'inscription") ?>
            <?= input('number', 'montant_mensuel', "Mensualité") ?>
            <?= input('number', 'effectif', "Effectif autorisé") ?>

            <div class="d-flex justify-content-end">
                <?= input('submit', 'btn-ajout-section', '', 'btn btn-primary px-5', "Ajouter") ?>
            </div>
        </form>
    </div>

    <!-- Fin du col-md-3 -->
    <div class="col-sm-4">
        <h5>Les matières dans une class</h5>
        <form action="fonctions/traitements.php" method="POST">
            <div class="form-group">
                <label for="">Classe </label>
                <select class="form-control" name="section_id" required id="">
                    <option value="" selected>--------</option>
                    <?php foreach (toutesLigne("sections") as $classe) : ?>
                        <option><?= $classe['section'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Matière </label>
                <select class="form-control" name="matiere_id" required id="">
                    <option value="" selected>--------</option>
                    <?php foreach (toutesLigne("matieres") as $m) : ?>
                        <option><?= $m['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Enseignant </label>
                <select class="form-control" name="enseignant_id" required id="">
                    <option value="" selected>--------</option>
                    <?php foreach (toutesLigne("enseignants") as $e) : ?>
                        <option><?= $e['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="modal-footer">
                <?= input('submit', 'btn-ajout-enseignement', '', 'btn btn-primary px-5', "Ajouter") ?>
            </div>
        </form>
    </div>
</div>

<!-- Affichage des matières sous form d'un tableau -->
<?php if (nombre_ligne('matieres', 'identifiant') != 0) : ?>
    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>Identifiant</th>
                <th>Matières</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (toutesLigne("matieres") as $m) : ?>
                <tr>
                    <td><?= $m['identifiant'] ?></td>
                    <td><?= $m['nom'] ?></td>
                    <td class="d-flex justify-content-between">
                        <a href="index.php?p=classes&sup=<?= $m['identifiant'] ?>" confirm="confirm('Voulez vous supprimer la section <?= $classe['identifiant'] ?> ?')" class="btn btn-danger">-</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<!-- Liste des sections sous form des liens -->
<div class="col-sm-2">
    <?php foreach (toutesLigne("sections") as $classe) : ?>
        <a href="index.php?p=enseignement&se=<?= $classe['identifiant'] ?>"><?= $classe['section'] ?> </a> <br> <br>
    <?php endforeach; ?>
</div>

<!-- Liste des enseignants -->
<section>
    <?php if (isset($_GET['se']) && !empty($_GET['se'])) : ?>
        <?php if (ligne_existe('enseigner', $_GET['se'], 'section_id') != 0) : ?>
            <h4>Enseignement</h4>
            <table class="table table-striped table-inverse table-responsive">
                <thead class="thead-inverse">
                    <th colspan=2 class="text-center"><?= uneLigne("sections", "identifiant", $_GET['se'])['section'] ?></th>
                    <tr>
                        <th>Matière</th>
                        <th>Enseignant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (enseignement($_GET['se']) as $e) : ?>
                        <tr>
                            <td><a href=""><?= $e['nom'] ?> </a></td>
                            <td><a href=""><?= $e['nom_e'] ?> </a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php endif; ?>
</section>


<!-- formulaire d'ajout des enseignants -->
<section>
    <h4>Ajout d'un enseignant</h4>
    <form action="fonctions/traitements.php" method="POST">
        <div class="row">
            <div class="col-6">
                <?= input('text', 'nom', "Nom") ?>
            </div>
            <div class="col-6">
                <?= input('tel', 'telephone', "Téléphone") ?>
            </div>
            <div class="col-6">
                <?= input('email', 'email', "E-mail") ?>
            </div>
            <div class="col-6">
                <?= input('text', 'residence', "Résidence") ?>
            </div>
        </div>
        <div class="modal-footer">
            <?= input('submit', 'btn-ajout-enseignant', '', 'btn btn-primary px-5', "Ajouter") ?>
        </div>
    </form>
</section>



<section>
    <div id="liste_enseignant">
        <?php if (nombre_ligne('enseignants', 'identifiant') != 0) : ?>
            <table class="table table-striped table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>E-mail</th>
                        <th>Résidence</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1;
                    foreach (toutesLigne("enseignants") as $e) : ?>
                        <tr>
                            <td><?= $count ?></td>
                            <td><?= $e['nom'] ?></td>
                            <td><?= $e['telephone'] ?></td>
                            <td><?= $e['email'] ?></td>
                            <td><?= $e['residence'] ?></td>
                            <td class="d-flex justify-content-between">
                                <a href="index.php?p=classes&sup=<?= $m['identifiant'] ?>" confirm="confirm('Voulez vous supprimer la section <?= $classe['identifiant'] ?> ?')" class="btn btn-danger">-</a>
                            </td>
                        </tr>
                    <?php $count++;
                    endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <button class="btn btn-primary" id="im_liste_enseignant">Imprimer la liste des enseignant</button>
</section>



<section>
    <h4>Déclaration des résultats</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form class="" method="POST" action="fonctions/traitements.php">
                        <div class="form-group">
                            <label for="default" class="col-sm-2 control-label">Nom de la class</label>
                            <div class="col-sm-10">
                                <select class="form-control clid" name="section_id" onChange="getStudent(this.value);" required id="classid">
                                    <option value="" selected>--------</option>
                                    <?php foreach (toutesLigne("sections") as $classe) : ?>
                                        <option value="<?= $classe['identifiant'] ?>"><?= $classe['section'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label ">Nom de l'élève</label>
                            <div class="col-sm-10">
                                <select name="eleve_id" class="form-control stid" id="studentid" required="required" onChange="getresult(this.value);">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <div id="reslt">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date" class="col-sm-2 control-label">Matières</label>
                            <div class="col-sm-10">
                                <div id="subject">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" id="btn-ajout-resultat" name="btn-ajout-resultat" class="btn btn-primary" value="Déclarer les résultats">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-md-12 -->
    </div>
</section>

<section>
    <h4>Affichage des résultats</h4>
    <form class="" method="POST" action="fonctions/traitements.php">
        <div class="form-group">
            <label for="default" class="col-sm-2 control-label">Nom de la class</label>
            <div class="col-sm-10">
                <select class="form-control clid" name="id_section" onChange="afficheEleves(this.value);" required id="section_id">
                    <option value="" selected>--------</option>
                    <?php foreach (toutesLigne("sections") as $classe) : ?>
                        <option value="<?= $classe['identifiant'] ?>"><?= $classe['section'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label ">Nom de l'élève</label>
            <div class="col-sm-10">
                <select name="id_eleve" class="form-control stid" id="eleve" required="required" onChange="afficheReleve(this.value)">
                </select>
            </div>
        </div>
    </form>
    <div class="form-group">
        <div class="col-sm-10">
            <div id="reslt">
            </div>
        </div>
    </div>

    <div class="my-5">
        <div class="col-sm-10">
            <div id="resultats">
                <!-- Affiache des fiches des résultats -->
            </div>
            <button class="btn  btn-primary" id="btn_telecharger_releve">Télécharger le relevé</button>
        </div>
    </div>

</section>


<script src="../static/js/script-ajax.js"></script>
<?php include_once 'include/footer.php' ?>