<div class="jumbotron text-center">
        <h1>Erreur </h1>
</div>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header active">
      <a class="navbar-brand" href="javascript:history.go(-1)">Retour</a>
    </div>
  </div>
</nav>
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-12">
            <h1</h1>
            <p><?php echo $errorMessage ?></p>

        </div>
    </div>
</div>
<hr> 

<?php require('view/footer.php'); ?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>