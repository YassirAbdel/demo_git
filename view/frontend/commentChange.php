<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
    <h1>Mon super blog !</h1>
    <p><a href="index.php">Commentaite à changer</a></p>
    
    <p>Le commentaire à modifier : <br> 
    "<?= $comment['comment'] ?>" posté le <?= $comment['comment_date_fr'] ?> par <?= $comment['author'] ?>
        
    <form action="index.php?action=changeComment" method="post">
        <input type="hidden" name="id" value="<?= $_GET['id'] ;?>" />
        <input type="hidden" name="postId" value="<?= $_GET['postId'] ;?>" />
        <div>
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="author" />
        </div>
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>