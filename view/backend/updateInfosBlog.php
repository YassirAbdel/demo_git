<?php require('view/entete.php'); ?>
    
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-12">
            <h4>Mettre des informations sur le blog : </h4> 
    
            <form action="index.php?action=<?php if (isset($infosBlog['id'])) { echo 'updateBlog'; } else { echo 'addBlog'; }?>" method="post">
            <div class="form-group">
                <label for="author">Titre</label><br />
                <input type="text" class="form-control" name="title"  <?php if (isset($infosBlog['title'])) { echo 'value=\'' . $infosBlog['title'] . '\''; } ?>/>
           </div>
            <div class="form-group">
                <label for="comment">Présentation du blog</label><br />
                <textarea  class="form-control" name="biography"><?php if (isset($infosBlog['biography'])) { echo $infosBlog['biography']; } ?></textarea>
                <?php if (isset($infosBlog['id'])) { echo '<input type=\'hidden\' name=\'idBlog\' value=\'' . $infosBlog['id'] . '\' />' ;} ?>
                <br />
            </div>
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