<div class="card text-left my-5" id="fiche_resultat">
    <div class="card-header"><?= $sql_eleve['nom_e'] ?></div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <img src="static/fichiers/defaut.png" class="img-fluid mx-auto img-thumbnail w-100 ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
            </div>
            <div class="col-12 col-sm-8 col-md-8">
                <h3> <b><?= $sql_eleve['nom_e'] ?></b></h3>
                <h4> <b><?= $sql_eleve['matricule'] ?></b></h4>

                <b><?= $sql_eleve['section'] ?></b> <br>
                <b>Né(e) le : <?= $sql_eleve['date_naissance'] ?></b> <br>
            </div>
        </div>
        <div id="" class="no-uicustom bg-info my-2"></div>
        <div class="mt-5">
            <table class="table table-bordered">
                <?php foreach ($resultat as $r) : ?>
                    <tr>
                        <td><?= $r['nom'] ?></td>
                        <td><?= $r['mentions'] ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>