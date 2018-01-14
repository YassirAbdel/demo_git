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
      <h2><?= htmlspecialchars($post['title']) ?></h2>
      <h5><span class="glyphicon glyphicon-time"></span> Posté le <?= $post['creation_date_fr'] ?>.</h5>
      <p><?= nl2br($post['content']) ?></p>
      
      <h4><span class="badge"><?= $counter['counter'] ?></span> commentaires</p></h4>
      
        <?php
        while ($comment = $comments->fetch())
        {
        ?>
            
            <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
            <p><?= nl2br($comment['comment']) ?></p>
            
            <?php
            if ($comment['status'] == 0) {
                echo '<a href=\'index.php?action=addReport&idComment=' . $comment['id'] . '&idPost=' . $post['id'] . '\'><button type=\'button\' class=\'btn btn-primary\'>Signaler</button></a><br><br>';
            
            } elseif ($comment['status'] == 2) {
                echo '<button type=\'button\' class=\'btn btn-danger\'>Commentaire signalé au modérateur</button><br><br>';
           
            } elseif ($comment['status'] == 1) {
                echo '<button type=\'button\' class=\'btn btn-success\'>Commentaire validé par le modérateur</button><br><br>';;
            }
            
            ?>
           
        <?php
        }
        
        $comments->closeCursor();
       
       ?>
<br>
<h4>Laisser un commentaire :</h4>     
<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div class="form-group">
        <label for="author">Auteur</label><br />
        <input type="text" class="form-control" id="author" name="author" />
    </div>
    <div class="form-group">
        <label for="comment">Commentaire</label><br />
        <textarea class="form-control" id="comment" name="comment"  rows="3"></textarea>
    </div>
    <div>
        <button type="submit" class="btn btn-default">Envoyer</button>
    </div>
</form>
<hr>
  </div>
  </div>
</div>
<?php require('view/footer.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>