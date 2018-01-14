<?php require('view/entete.php'); ?>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-12">
            <h4>Ajouter un post :</h4>  
            <form action="index.php?action=addPost" method="post">
                <div class="form-group">
                    <label for="title">Titre</label><br />
                    <input type="text" class="form-control" name="title" id="author">
                </div>
                <div class="form-group">
                    <label for="comment">Contenu</label><br />
                    <textarea class="form-control" name="content"></textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-default">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<hr> 

<?php require('view/footer.php'); ?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>