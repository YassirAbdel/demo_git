<?php

require('controler/frontend.php');
require('controler/backend.php');

try
{
    // backend v3
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post($_GET['id']);
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                
                else {
                
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            
            else {
                
                throw new Exception ('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'getComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                getComment($_GET['id']);
            }
            else {
                
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        
        // frontend
        elseif ($_GET['action'] == 'admin') {
            getAdmin();
        }
        elseif ($_GET['action'] == 'getUpdatePost') {
            getUpdatePost($_GET['id']);
        }
        elseif ($_GET['action'] == 'updatePost') {
            updatePost($_POST['title'], $_POST['content'], $_POST['id']);
        }
        elseif ($_GET['action'] == 'insertPost') {
            getInsertPost();
        }
        elseif ($_GET['action'] == 'deletePost') {
            deletePost($_GET['id']);
        }
        elseif ($_GET['action'] == 'addPost') {
            if (!empty($_POST['title']) && !empty($_POST['content'])) {
                insertPost($_POST['title'], $_POST['content']);
            }
            else {
                throw new Exception('Le post n\'a pas été ajouté');
            }
        }
        elseif ($_GET['action'] == 'getPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                getPost($_GET['id']);
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'deleteComment') {
            if (isset($_GET['commentId']) && $_GET['postId'] > 0) {
                
                deleteComment($_GET['commentId'], $_GET['postId']);
            }
            else {
                throw new Exception('Suppression impossible !');
            }
        }
        elseif ($_GET['action'] == 'registration') {
            getFormRegist();
        }
        elseif ($_GET['action'] == 'connect') {
            
          if (isset($_COOKIE['pseudo']) && isset($_COOKIE['pass'])) {
              connectUser($_COOKIE['pseudo'], $_COOKIE['pass']);
              
          }
          else {
              getFormconnect();
          }  
            
        }
        elseif ($_GET['action'] == 'addUser') {
            if (isset($_POST['pseudo']) && isset($_POST['pass']) && isset($_POST['email']) && isset($_POST['profile'])) {
                ////pseudo, pass, email, datecreate, dateupdate, profile, name, firstname, biography
                
                addUser($_POST['pseudo'], $_POST['pass'], $_POST['email'], $_POST['profile'], $_POST['name'], $_POST['firstname']);
            }
        }
        elseif ($_GET['action'] == 'connectUser') {
            if (isset($_POST['pseudo']) && isset($_POST['pass']) && isset($_POST['cookie'])) {
                addCookie($_POST['pseudo'], $_POST['pass']);
                connectUser($_POST['pseudo'], $_POST['pass']);
                
            }
         
            elseif (isset($_POST['pseudo']) && isset($_POST['pass'])) {
                connectUser($_POST['pseudo'], $_POST['pass']);
            }
            else {
                throw new Exception('Impossible de se connecter');
            }
            
        }
        elseif ($_GET['action'] == 'getUpdateUser') {
            if (isset($_GET['id'])) {
                    getUpdateUser($_GET['id']);
                
            }
            else {
                throw new Exception('Mise à jour du compte impossible');
            }
        }
        elseif ($_GET['action'] == 'updateUser') {
            if (isset($_POST['id'])) {
                updateUser($_POST['pseudo'], $_POST['pass'], $_POST['email'], $_POST['profile'], $_POST['name'], $_POST['firstname'], $_POST['id']);
            }
            else {
                throw new Exception('Mise à jour du compte impossible');
            }
        }
        elseif ($_GET['action'] == 'getFormBlog') {
            getFormBlog();
        }
        elseif ($_GET['action'] == 'addBlog') {
            if (isset($_POST['title']) && isset($_POST['biography'])) {
                InsertBlog($_POST['title'], $_POST['biography']);
            } else {
                throw new Exception('Impossibe de créer le blog');
            }
        }
        elseif ($_GET['action'] == 'getFormUpdateBlog') {
            if (isset($_GET['idBlog'])) {
                GetFormUpdateBlog($_GET['idBlog']);
            }
            else {
                throw new Exception('Impossible de charge le fomulaire');
            }
        }
        elseif ($_GET['action'] == 'updateBlog') {
            if (isset($_POST['idBlog'])) {
                updateBlog($_POST['title'], $_POST['biography'], $_POST['idBlog']);
            }
            else {
                throw new Exception('Mise à jour des infos blog impossible');
            }
        }
        elseif ($_GET['action'] == 'disconnect') {
            disconnect();
        }
        elseif ($_GET['action'] == 'addReport') {
            addReport($_GET['idComment']);
        }
        elseif ($_GET['action'] == 'validateComment') {
            validateComment($_GET['idComment']);
        }
        
    }
    else {
        listPosts();
    }
} 

catch (Exception $e) {
    $errorMessage = $e->getMessage();
    
    require('view/errorView.php');
}
