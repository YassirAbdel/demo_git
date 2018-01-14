<?php

while ($infos = $infosBlog->fetch())
{
?>
    <?php $title = $infos['title']; ?>
    <?php ob_start(); ?>
  
    <div class="jumbotron text-center">
        <h1><?= $infos['title']; ?></h1>
        <p><?= $infos['biography'] ?></p> 
    </div>
<?php
}
?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header active">
      <a class="navbar-brand" href="index.php">Retour à la page d'accueil</a>
    </div>
  </div>
</nav>
<div class="container-fluid">
    <div class="row content">
    <div class="col-sm-12">
        <h4>Administration du blog :</h4>     
        <form action="index.php?action=connectUser" method="post">
            <div class="form-group">
                <label for="author">Login</label><br />
                <input type="text" class="form-control" name="pseudo" id="pseudo">
            </div>
            <div class="form-group">
                <label for="comment">Mot de passe</label><br />
                <input type="password" class="form-control" name="pass" id="pass">
            </div>
            <div class="form-group">
                <label class="checkbox-inline"><input type="checkbox" name="cookie" id="cookie">Connexion automatique</label>
            </div>
    <div>
            <button type="submit" class="btn btn-default">Se connecter</button>
    </div>
</form>
<br><br><br>
<footer class="container-fluid">
    <p><a href="index.php?action=connect">Administration du blog</a></p>
</footer>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>

