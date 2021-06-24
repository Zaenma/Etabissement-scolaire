<?php include_once 'include/header.php' ?>

<h1 class="text-center text-primary mb-5">Les classes</h1>
<section>
    <div class="d-flex justify-content-between mb-2">
        <form action="" method="post">
            <div class="d-flex justify-content-between">
                <input type="search" name="" class="form-control mr-3" id="">
                <input type="submit" class="btn btn-info" value="Chercher">
            </div>
        </form>
        <div class="btn btn-primary">
            <a type="button" data-toggle="modal" data-target="#modal-ajout" href="" class="text-white">+</a> <br>
        </div>
        <!-- Inclusion de la boite modal dans le fichier index -->
    </div>
</section>

<section>
    <div class="row">
        <div class="col-sm-10">
            <?php if (nombre_ligne('sections', 'identifiant') != 0) : ?>
                <table class="table">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th>Section</th>
                            <th>Inscription</th>
                            <th>Mensualité</th>
                            <th>Effectif max</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $cont = 1;
                        foreach (toutesLigne("sections") as $classe) : ?>
                            <tr>
                                <td><?= $cont ?></td>
                                <td><?= $classe['section'] ?></td>

                                <td><?= ($classe['montant_inscription'] == NULL) ? 0 : $classe['montant_inscription'];  ?> FCFA</td>
                                <td><?= ($classe['montant_mensuel'] == NULL) ? 0 : $classe['montant_mensuel'];  ?> FCFA</td>
                                <td><?= ($classe['effectif'] == NULL) ? 0 : $classe['effectif'];  ?> FCFA</td>
                                <td class="d-flex justify-content-between">
                                    <a href="" class="btn btn-danger">-</a>
                                </td>
                            </tr>
                            <!-- Fin de la boucle foreach -->
                        <?php $cont++;
                        endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <div class="col-sm-2">
            <?php foreach (toutesLigne("sections") as $classe) : ?>
                <a href="index.php?p=classes&ac=<?= $classe['section'] ?>"><?= $classe['section'] ?> </a> <br> <br>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<?php include_once 'include/footer.php' ?>