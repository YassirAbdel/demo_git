<?php
//print_r($infosBlog);
while ($infos = $infosBlog->fetch())
        print_r($infos);
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

<div class="container-fluid">
  <div class="row content">
       
    <div class="col-sm-12">
      <h4><small>POSTS RÉCENTS</small></h4>
      <hr>

<?php

while ($data = $posts->fetch())
    
{
?>
      <h2><?= htmlspecialchars($data['title']) ?></h2>
      <h5><span class="glyphicon glyphicon-time"></span> Posté le <?= $data['creation_date_fr'] ?>.</h5>      
      <p><?= nl2br($data['content']) ?></p>
      <br>
      <a href="index.php?action=post&id=<?= $data['id'] ?>"><button type="button" class="btn btn-primary">Commentaires</button></a>    
      <br><br>
    
      <hr>
    
<?php
}
?>
    </div>
  </div>
</div>
<?php require('view/footer.php'); ?>
<?php
$posts->closeCursor();

?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>