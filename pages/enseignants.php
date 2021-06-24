<?php include_once 'include/header.php' ?>

<section class="section">
    <h4>Liste des enseignants</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body p-20">
                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Identifiant</th>
                            <th>Nom</th>
                            <th>Téléphone</th>
                            <th>E-mail</th>
                            <th>Résidence</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (toutesLigne("enseignants") as $e) : ?>
                            <tr>
                                <td><?= $e['identifiant'] ?></td>
                                <td><?= $e['nom'] ?></td>
                                <td><?= $e['telephone'] ?></td>
                                <td><?= $e['email'] ?></td>
                                <td><?= $e['residence'] ?></td>
                                <td class="d-flex justify-content-between">
                                    <a href="index.php?p=classes&sup=<?= $m['identifiant'] ?>" confirm="confirm('Voulez vous supprimer la section <?= $classe['identifiant'] ?> ?')" class="btn btn-danger">-</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- /.col-md-12 -->
            </div>
        </div>
    </div>
    <!-- /.col-md-6 -->
</section>
<!-- /.section -->




<?php include_once 'include/footer.php' ?>