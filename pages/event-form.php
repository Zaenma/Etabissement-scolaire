<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="date_debut">Date du début de l'évenement </label>
            <input type="date" class="form-control" name="date_debut" id="" value="<?= isset($donnees['date_debut']) ? htmlentities($donnees['date_debut']) : '' ?>" placeholder="Date du début de l'évenement" required>
            <?php if (isset($erreurs['date_debut'])) : ?>
                <p class="form-text text-danger"> <?= $erreurs['date_debut'] ?> </p>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="time">Heure de debut de l'évenment</label>
            <input type="time" class="form-control" name="heure_debut" id="" value="<?= isset($donnees['heure_debut']) ? htmlentities($donnees['heure_debut']) : '' ?>" placeholder="Heure de démarage de l'évenement " required>
            <?php if (isset($erreurs['heure_debut'])) : ?>
                <p class="form-text text-danger"> <?= $erreurs['heure_debut'] ?> </p>
            <?php endif; ?>
        </div>
    </div>
    <div class="line"></div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="date_fin">Date du début de l'évenement </label>
            <input type="date" class="form-control" name="date_fin" id="" value="<?= isset($donnees['date_fin']) ? htmlentities($donnees['date_fin']) : '' ?>" placeholder="Date du début de l'évenement" required>
            <?php if (isset($erreurs['date_fin'])) : ?>
                <p class="form-text text-danger"> <?= $erreurs['date_fin'] ?> </p>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="time">Heure de fin de fin l'évènement</label>
            <input type="time" class="form-control" name="heure_fin" id="" value="<?= isset($donnees['heure_fin']) ? htmlentities($donnees['heure_fin']) : '' ?>" placeholder="Heure du fin de l'évenement " required>
            <?php if (isset($erreurs['heure_fin'])) : ?>
                <p class="form-text text-danger"> <?= $erreurs['heure_fin'] ?> </p>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="line"></div>
<div class="form-group">
    <label for="titre">Titre de l'évenement </label>
    <input type="text" class="form-control" name="titre" id="titre" value="<?= isset($donnees['titre']) ? htmlentities($donnees['titre']) : '' ?>" aria-describedby="helpId" placeholder="Titre de l'évenement" required>
    <?php if (isset($erreurs['titre'])) : ?>
        <p class="form-text text-danger"> <?= $erreurs['titre'] ?> </p>
    <?php endif; ?>
</div>

<div class="line"></div>
<div class="form-group">
    <label for="type-evenement">Entrer le type d'évènement</label>
    <input type="text" name="type-evenement" class="form-control" value="<?= isset($donnees['type-evenement']) ? htmlentities($donnees['type-evenement']) : '' ?>">
    <?php if (isset($erreurs['type-evenement'])) : ?>
        <p class="form-text text-danger"> <?= $erreurs['type-evenement'] ?> </p>
    <?php endif; ?>
</div>
<div class="line"></div>
<div class="form-group">
    <label for="description">Déscription de l'évenement </label>
    <textarea name="description" id="" class="form-control" required placeholder="Description de l'évènement"><?= isset($donnees['description']) ? htmlentities($donnees['description']) : '' ?></textarea>
    <?php if (isset($erreurs['description'])) : ?>
        <p class="form-text text-danger"> <?= $erreurs['description'] ?> </p>
    <?php endif; ?>
</div>