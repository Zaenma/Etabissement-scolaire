<?php include_once 'include/header.php' ?>

<h1>Page d'acceuil</h1>

<form action="fonctions/traitements.php" method="POST">
    <div class="form-group">
        <label for="">Identifiant</label>
        <input type="text" class="form-control" name="identifiant" id="">
        <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    <div class="form-group">
        <label for="">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="">
    </div>
    <input type="submit" value="Me connecter" name="btn-connexion" class="btn btn-primary">
</form>

<?php include_once 'include/footer.php' ?>