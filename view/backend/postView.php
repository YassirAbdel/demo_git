<?php require('view/entete.php'); ?>

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
            <p><strong>Par <?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
            <?php echo nl2br($comment['comment']);
            if ($comment['status'] == 2) {
                echo "<p><button type='button' class='btn btn-danger'>Commentaire signalé</button></p>";
                
            } elseif ($comment['status'] == 1) {
                echo "<p><button type='button' class='btn btn-success'>Commentaire validé</button></p>";
            }
            ?>
            <a href="index.php?action=deleteComment&amp;commentId=<?= $comment['id']?>&amp;postId=<?= $comment['post_id']?>"><button type="button" class="btn btn-primary">Supprimer ce commentaire</button></a>
            <a href="index.php?action=validateComment&idComment=<?=$comment['id']?>&idPost=<?= $post['id']?>"><button type="button" class="btn btn-primary">Valider ce commentaire</button></a>
            <br><br>
            
          
       <?php
        }
        
        $comments->closeCursor();
       
    ?>
     


    </div>
  </div>
</div>
<hr> 

<?php require('view/footer.php'); ?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>

   