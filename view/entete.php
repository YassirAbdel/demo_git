<?php
session_start();

while ($infosBlogGlob = $descBlog->fetch())
{
?> 
    <?php $title = $infosBlogGlob['title']; ?>
    <?php ob_start(); ?>
 
    <div class="jumbotron text-center">
        <h1><?= $infosBlogGlob['title'];?></h1>
        <p><?= $infosBlogGlob['biography'] ?></p> 
    </div>

<?php
}
$descBlog->closeCursor();
?>

<h4>Bonjour <?= $_SESSION['firstname'] . ' ' . $_SESSION['name']?></h4>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header active">
      <a class="navbar-brand" href="#">Administation du blog : </a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php?action=admin">Liste des posts</a></li>
      <li><a href="index.php?action=insertPost">Créer un post</a></li>
      <li><a href="index.php?action=getUpdateUser&AMP;id=<?= $_SESSION['id'] ?>">Mettre à jour votre compte</a></li>
      <li><a href="index.php?action=registration">Créer un compte admin</a></li>
      <!--<li><a href="index.php?action=getFormBlog">Ajouter infos blog</a></li>-->
      <li><a href="index.php?action=getFormUpdateBlog&idBlog=3">Mettre à jour les infos du blog</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Accueil</a></li>
        <li><a href="index.php?action=disconnect"><span class="glyphicon glyphicon-log-in"></span> Fermer la session</a></li>
    </ul>  
    
  </div>
</nav>


