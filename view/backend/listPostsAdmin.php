<?php require('view/entete.php'); ?>

<div class="container-fluid">
  <div class="row content">
    <?php if(isset($message)) 
    {
        echo '<div class="alert alert-info">';
        echo  $message;
        echo '</div>';
     }
   ?>
    <div class="col-sm-12">
      <h2><small>Les posts :</small></h2>
      <hr>

<?php
foreach( $posts as $data)
{
?>
        
        <h2><?= htmlspecialchars($data['title']) ?></h2>
        <h5><span class="glyphicon glyphicon-time"></span> créé le <?= $data['creation_date_fr'] ?>.</h5> 
        <p><?= nl2br($data['content']) ?></p>
        <p><?php
            if ($counter[$data['id']]['counter'] >= 1)
            { 
             echo '<button type=\'button\' class=\'btn btn-danger\'>' . $counter[$data['id']]['counter'] . ' commentaire (s) signalé (s)</button><br><br>';
            }
         ?>
        </p>
        <a href="index.php?action=getPost&id=<?= $data['id'] ?>"><button type="button" class="btn btn-primary">Gérer les commentaires</button></a>
        <a href="index.php?action=getUpdatePost&id=<?= $data['id'] ?>"><button type="button" class="btn btn-primary">Mettre à jour le post</button></a>
        <a href="index.php?action=deletePost&id=<?= $data['id'] ?>"><button type="button" class="btn btn-primary">Supprimer le post</button></a>
        <br>
        
        <hr>    

<?php
}
?>
    </div>
  </div>
</div>
<?php require('view/footer.php'); ?>
        
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
