<?php require('view/entete.php'); ?>
    
    <div class="container-fluid">
    <div class="row content">
        <div class="col-sm-12">
            <h4>Mettre à jour un post</h4> 
    
    <form action="index.php?action=updatePost" method="post">
        <div class="form-group">
            <label for="author">Titre</label><br />
            <input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
            <input type="text" class="form-control" id="author" name="title" value="<?php echo $post['title']?>" />
        </div>
        <div>
            <label for="comment">Contenu</label><br />
            <textarea id="comment" name="content"><?php echo $post['content']?></textarea>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-default">Valider</button>
        </div>
    </form>

    </div>
  </div>
  </div>
<hr> 

<?php require('view/footer.php'); ?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>