<?php include_once 'include/header.php' ?>
<h1 class="text-center text-primary my-5">Les élèves</h1>

<div class="row">
    <!-- colone principale -->
    <div class="col-10">


        <section>
            <!-- Affichage de la liste des élèves d'une classe passée en GET -->
            <?php if (!empty($_GET['c'])) : ?>
                <!-- Si la liste demandée ne contient d'enrégistrement -->
                <?php if (listeElevesParClasse($_GET['c']) == null) : ?>
                    <div class="alert alert-warning text-white alert-dismissible fade show" role="alert">
                        <strong>Hello Directrice !</strong> La liste des élèves de cette classe est vide
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php else : ?>
                    <!-- La liste n'est pas vide -->
                    <section>
                        <table class="table table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Matricule | Afficher détails</th>
                                    <th>Nom</th>
                                    <th>Réligion</th>
                                    <th>Responsable</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (listeElevesParClasse($_GET['c']) as $e) : ?>
                                    <tr>
                                        <td> <a href="index.php?p=eleves&id=<?= $e['identifiant'] ?>"><?= $e['matricule'] ?></a> </td>
                                        <td><?= $e['nom_e'] ?></td>
                                        <td><?= $e['religion'] ?></td>
                                        <td><?= $e['nom_r'] ?></td>
                                        <td class="d-flex justify-content-between">
                                            <a href="" confirm="" class="btn btn-danger">-</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </section>
                <?php endif; ?>
            <?php endif; ?>
        </section>


        <!-- Affiche les détils d'un élève sous forme d'une carte -->
        <?php if (isset($_GET['id'])) : ?>
            <div id="fiche_detail">
                <?php $eleve = uneLigne('eleves', 'identifiant', $_GET['id']); ?>
                <div id="" class="card text-left">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <p> Fiche de <b><?= $eleve['nom_e'] ?></b></p>
                            <p> Au bonheur des enfants | école Franco-Arabe</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Identité de l'élève</p>
                        <div id="" class="no-uicustom bg-info mb-2"></div>
                        <div class="row">
                            <div class="col-3">
                                <img src="static/fichiers/defaut.png" class="img-fluid mx-auto img-thumbnail w-100 ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            </div>
                            <div class="col-12 col-sm-8 col-md-8">
                                <h4> <b><?= $eleve['nom_e'] ?> | <?= $eleve['matricule'] ?></b> </h4> <br>
                                <b>Né le : <?= $eleve['date_naissance'] ?></b> <br>
                                <b>Réligion : <?= $eleve['religion'] ?></b> <br>
                                <b>Main principale : <?= $eleve['emprinte'] ?></b> <br>
                                <b>Section : <?= uneLigne('sections', 'identifiant', $eleve['section_id'])['section'] ?></b> <br>
                            </div>
                        </div>
                        <?php if ($eleve['malade'] == 1 or $eleve['ecole'] == 1) : ?>
                            <p class="mt-5">Autres informations</p>
                            <div id="" class="no-uicustom bg-info mb-2"></div>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">

                                    <?php if ($eleve['malade'] == 1) : ?>
                                        <p>L'enfant a des symptomes paticuliers qui sont : </p>
                                        <p><?= $eleve['symptome'] ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <?php if ($eleve['ecole'] == 1) : ?>
                                        <p>L'encienne école fréquentée est : </p>
                                        <p><?= $eleve['infos_ecole'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <p class="mt-5">Informations des parents</p>
                        <div id="" class="no-uicustom bg-info mb-2"></div>
                        <h5> <b>Père : <?= $eleve['nom_r'] ?> </b></h5>
                        <div class="row">
                            <div class="col">
                                <p><b>Téléphone : <?= $eleve['telephone'] ?></b> <br></p>
                            </div>
                            <div class="col">
                                <p><b>E-mail : <?= $eleve['email'] ?></b> </p>
                            </div>
                            <div class="col">
                                <p><b>Proféssion : <?= $eleve['profession'] ?></b></p>
                            </div>
                            <div class="col">
                                <p><b>Résidence : <?= $eleve['adresse'] ?></b></p>
                            </div>
                        </div>
                        <h5><b>Mère : <?= $eleve['nom_r'] ?> </b></h5>
                        <div class="row">

                            <div class="col">
                                <p><b>Téléphone : <?= $eleve['telephone'] ?></b> <br></p>
                            </div>
                            <div class="col">
                                <p><b>E-mail : <?= $eleve['email'] ?></b> </p>
                            </div>
                            <div class="col">
                                <p><b>Proféssion : <?= $eleve['profession'] ?></b></p>
                            </div>
                            <div class="col">
                                <p><b>Résidence : <?= $eleve['adresse'] ?></b></p>
                            </div>
                        </div>
                        <p>Engagement</p>
                        <div id="" class="no-uicustom bg-info mb-2"></div>
                        <p>Je m'engage en tant que <?= $eleve['lien'] ?> de l'élève <?= $eleve['nom_e'] ?> à payer la mensualité du mois de novenbre jusqu'au mois de.....</p>
                        <div class="d-flex justify-content-between">
                            <p>PERE</p>
                            <p>MERE</p>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            <button class="btn btn-primary my-5" id="btn_detail_eleve">Télécharger la fiche</button>
        <?php endif; ?>

        <!-- Section d'affichage de la liste des élèves -->
        <section id="liste-eleves">
            <div class="row">
                <h3>Lites des parents</h3>
                <div class="col-sm-10">
                    <form action="fonctions/traitements.php" method="POST">
                        <div class="row">
                            <div class="col-6">
                                <?= input('text', 'nom_e', "Nom de l'élève") ?>
                            </div>
                            <div class="col-6">
                                <?= input('date', 'date_naissance', "Date de naissance") ?>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Réligieon</label>
                                    <select class="form-control" name="religion" required id="">
                                        <option value="" selected>--------</option>
                                        <option>Misulmane</option>
                                        <option>Chrétienne</option>
                                        <option>Autre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Emprintes </label>
                                    <select class="form-control" name="emprinte" required id="">
                                        <option value="" selected>--------</option>
                                        <option>Guache</option>
                                        <option>Droit</option>
                                        <option>Autre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">A t-il des syptomes paticuliers ?</label>
                                    <select class="form-control" name="malade" required id="">
                                        <option value="" selected>--------</option>
                                        <option>Oui</option>
                                        <option>Non</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <?= input('text', 'symptome', "Les symptomes") ?>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Avez vous rejoint une école avant ?</label>
                                    <select class="form-control" name="ecole" required id="">
                                        <option value="" selected>--------</option>
                                        <option>Oui</option>
                                        <option>Non</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <?= input('text', 'infos_ecole', "La précédente école") ?>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Niveau d'inscrition</label>
                                    <select class="form-control" name="section_id" required id="">
                                        <option value="" selected>--------</option>
                                        <?php foreach (toutesLigne("sections") as $classe) : ?>
                                            <option><?= $classe['section'] ?></option>
                                        <?php endforeach; ?>
                                        <option>Non</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <h4>Information du responsable</h4>
                            </div>
                            <div class="col-6">
                                <?= input('text', 'nom_r', "Nom") ?>
                            </div>
                            <div class="col-6">
                                <?= input('tel', 'telephone', "Téléphone") ?>
                            </div>
                            <div class="col-6">
                                <?= input('email', 'email', "Adresse") ?>
                            </div>
                            <div class="col-6">
                                <?= input('text', 'adresse', "Résidence") ?>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Lien famillial</label>
                                    <select class="form-control" name="lien" required id="">
                                        <option value="" selected>--------</option>
                                        <option>Père</option>
                                        <option>Mère</option>
                                        <option>Autre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <?= input('text', 'profession', "Profféssion") ?>
                            </div>
                            <div class="col-12">
                                <label for="">Pourquoi avez-vous choisi notre l'école ?</label>
                                <textarea name="motif" class="form-control" id="" cols="8" rows="3"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="" class="mt-4">Engagement</label>
                                <textarea name="engagement" class="form-control" id="" cols="8" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <?= button_submit('btn-ajout-eleve', 'btn btn-primary px-5', 'Enregistrer') ?>
                        </div>
                    </form>
                </div>
            </div>
            <button class="btn-btn-primary" id="btn_liste_eleve">Télécharger la liste</button>
        </section>


    </div><!-- Fin de la colone principale -->

    <!-- Liste des classe -->
    <div class="col-2">
        <?php foreach (toutesLigne("sections") as $classe) : ?>
            <a href="?p=eleves&c=<?= $classe['identifiant'] ?>"><?= $classe['section'] ?> </a> <br> <br>
        <?php endforeach; ?>
    </div> <!-- Fin de la liste de classe -->
</div>

<?php include_once 'include/footer.php' ?>