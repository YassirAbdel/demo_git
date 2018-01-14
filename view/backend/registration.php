<?php require('view/entete.php'); ?>

    <div class="container-fluid">
    <div class="row content">
        <div class="col-sm-12">
            <h4><?php if ($_GET['action'] == 'getUpdateUser') {echo 'Mettre à jour votre compte';} else {echo 'Ajouter un compte Admin';}?></h4>
            <form method="post" action="index.php?action=<?php if ($_GET['action'] == 'getUpdateUser') {echo 'updateUser';} else {echo 'addUser';}?>">
                <div class="form-group">
                    <label for="pseudo">Login</label></br>
                    <input type="text" class="form-control" name="pseudo" id="pseudo" <?php if (isset($infosUser['pseudo'])) echo 'value=\'' . $infosUser['pseudo'] . '\''; ?> />
                </div>
                <div class="form-group">
                    <label for="pass"><?php if (isset($infosUser['pass'])) echo 'Nouveau mot de passe'; else echo 'Mot de passe'; ?></label><br />
                    <input type="password" class="form-control" name="pass" id="password" />
                </div>
                <div class="form-group">
                    <label for="email">Email</label><br />
                    <input type="text" class="form-control" name="email" id="email" <?php if (isset($infosUser['email'])) echo 'value=\'' . $infosUser['email'] . '\''; ?> />
                </div>
                <div class="form-group">
                     <label for="name">Nom</label><br />
                     <input type="text" class="form-control" name="name" id="name" <?php if (isset($infosUser['name'])) echo 'value=\'' . $infosUser['name'] . '\''; ?>/>
                </div>
                <div class="form-group">
                    <label for="firstname">Prénom</label><br />
                    <input type="text" class="form-control" name="firstname" id="firstname" <?php if (isset($infosUser['firstname'])) echo 'value=\'' . $infosUser['firstname'] . '\''; ?>/>
                </div>
                <?php if (isset($infosUser['id'])) {echo '<input type=\'hidden\' name=\'id\' value=\'' . $infosUser['id'] . '\'/>';}?>
                <input type="hidden" name="profile" value="admin"/>
                <input type="submit" value="Valider" />
                    
            </form> 
            </div>
    </div>
</div>
<hr> 

<?php require('view/footer.php'); ?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>

    
    <!--<div class="form-group">
                    <label for="title">Titre</label><br />
                    <input type="text" class="form-control" name="title" id="author">
        </div>-->