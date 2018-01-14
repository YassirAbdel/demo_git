<?php

require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';
require_once 'model/UserManager.php';
require_once 'model/BlogManager.php';

# 1. AFFICHAGE DES POSTS DANS L'ESPACE ADMIN
function getAdmin()
{
    $postManager = new Writer\Blog\Model\PostManager;
    $blogManager = new Writer\Blog\Model\BlogManager;
    $commentManager = new \Writer\Blog\Model\CommentManager();
    
    $posts = $postManager->getAllPosts();
    $descBlog = $blogManager->getBlog();
    foreach ($posts as $data)
    {
        $counter[$data['id']] = $commentManager->matchReportComments($data['id']);
    }
    
    require 'view/backend/listPostsAdmin.php';
}

# 2. AFFICHAGE DU FORMULAIRE DE MISE A JOUR DES INFOS DU BLOG
function getInsertPost() 
{
    $blogManager = new Writer\Blog\Model\BlogManager;
    $descBlog = $blogManager->getBlog();
    
    
    require('view/backend/insertPost.php');
}

# 3. AJOUT D'UN NOUVEAU POST
function insertPost($title, $content) 
{
    $postManager = new \Writer\Blog\Model\PostManager;
    $blogManager = new Writer\Blog\Model\BlogManager;
    $commentManager = new \Writer\Blog\Model\CommentManager();
    
    $affectedLines = $postManager->createPost($title, $content);
    $posts = $postManager->getAllPosts();
    $descBlog = $blogManager->getBlog();
    
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter un post');
    }
    else {
        foreach ($posts as $data)
        {
            $counter[$data['id']] = $commentManager->matchReportComments($data['id']);
        }
        require 'view/backend/listPostsAdmin.php';
    }
}

# 4. AFFICHAGE DU FORMULAIRE DE MISE À MISE À JOUR D'UN POST
function getUpdatePost($id)
{
    $postManager = new \Writer\Blog\Model\PostManager;
    $blogManager = new Writer\Blog\Model\BlogManager;
    
    $post = $postManager->getPost($id);
    $descBlog = $blogManager->getBlog();
    
    require 'view/backend/updatePost.php';
}

# 5. MISE À JOUR D'UN POST
function updatePost($title, $content, $id)
{
    $posManager = new \Writer\Blog\Model\PostManager;
    $blogManager = new Writer\Blog\Model\BlogManager;
    $affectedLines = $posManager->updatePost($title, $content, $id);
    $commentManager = new \Writer\Blog\Model\CommentManager();
    
    $posts = $posManager->getAllPosts();
    $descBlog = $blogManager->getBlog();
    
    if ($affectedLines === false) {
        throw new Exception('Impossible de mettre à jour le post');
    }
    else {
        foreach ($posts as $data)
         {
            $counter[$data['id']] = $commentManager->matchReportComments($data['id']);
         }
        session_start();
        require 'view/backend/listPostsAdmin.php';
    }
}

# 6. SUPPRESSION D'UN POST
function deletePost($id)
{
    $postManager = new \Writer\Blog\Model\PostManager();
    $blogManager = new Writer\Blog\Model\BlogManager;
    $commentManager = new \Writer\Blog\Model\CommentManager();
    
    $affectedLine = $postManager->deletePost($id);
    $posts = $postManager->getAllPosts();
    $descBlog = $blogManager->getBlog();
    
    if ($affectedLine === false) {
        throw new Exception('Impossible de mettre à jour le post');
    }
    else {
        foreach ($posts as $data)
         {
            $counter[$data['id']] = $commentManager->matchReportComments($data['id']);
         }
        require 'view/backend/listPostsAdmin.php';
    }
        
}

# 7. AFFICHAGE D'UN POST
function getPost($id)
{
    $postManager = new Writer\Blog\Model\PostManager();
    $commentManager = new \Writer\Blog\Model\CommentManager();
    $blogManager = new Writer\Blog\Model\BlogManager;
    
    $post = $postManager->getPost($id);
    $comments = $commentManager->getCommentsByStatus($id);
    $descBlog = $blogManager->getBlog();
    $counter = $commentManager->matchComments($id);

    session_start();
    require('view/backend/postView.php');
}

# 8. SUPPRESSION D'UN COMMENTAIRE
function deleteComment($commentId, $postId)
{
    $commentManager = new Writer\Blog\Model\CommentManager();
    $postManager = new Writer\Blog\Model\PostManager();
    $blogManager = new Writer\Blog\Model\BlogManager;
    
    $affectedLines = $commentManager->deleteComment($commentId);
    $post = $postManager->getPost($postId);
    $comments = $commentManager->getCommentsByStatus($postId);
    $descBlog = $blogManager->getBlog();
    $counter = $commentManager->matchComments($postId);
    
    if ($affectedLines === FALSE) {
        throw new Exception('Imposible de mettre à jour le commentaire');
    }
    else {
        session_start();
        require('view/backend/postView.php');
    }
}

# 9. AFFICHAGE DU FORMULAIRE DE CONNEXION À L'ESPACE ADMIN
function getFormconnect()
{
    $blog = new Writer\Blog\Model\BlogManager();
    $infosBlog = $blog->getBlog();
    require_once 'view/backend/formConnect.php';
}

# 10. AFFICHAGE DU FORMULAIRE DE MISE A JOUR DES INFORMATIONS DU BLOG
function getFormRegist()
{
    $blogManager = new Writer\Blog\Model\BlogManager;
    $descBlog = $blogManager->getBlog();
    
    require_once 'view/backend/registration.php';
}

# 11. CRÉATION D'UN COMPTE ADMIN
function addUser($pseudo, $pass, $email, $profile, $name, $firstname)
{
    $addUser = new Writer\Blog\Model\UserManager();
    $postManager = new Writer\Blog\Model\PostManager();
    $blogManager = new Writer\Blog\Model\BlogManager;
    $commentManager = new \Writer\Blog\Model\CommentManager();
    
    $posts = $postManager->getAllPosts();
    $descBlog = $blogManager->getBlog();
    
    if (empty($pseudo) || empty($pass) || empty($email) || empty($profile) || empty($name) || empty($firstname)) {
        
        throw new Exception('Imposible d\'ajouter cd compte car tous les champs sont obligatoires');
    }
    else {
        $pass = sha1($pass);
        $affectedLines = $addUser->createUser($pseudo, $pass, $email, $profile, $name, $firstname);
    }
    if ($affectedLines === FALSE) {
        throw new Exception('Imposible de créer une nouveau compte');
    }
    else {
        foreach ($posts as $data)
            {
                $counter[$data['id']] = $commentManager->matchReportComments($data['id']);
            }
        $message = 'Un compte Admin est ajouté';
        require 'view/backend/listPostsAdmin.php';
    }
}

# 12. CONNEXION A L'ESPACE ADMIN
function connectUser ($pseudo, $pass)
{
    $user = new Writer\Blog\Model\UserManager();
    $postManager = new Writer\Blog\Model\PostManager();
    $blogManager = new Writer\Blog\Model\BlogManager;
    $commentManager = new Writer\Blog\Model\CommentManager();
    
    if (isset($_COOKIE['pass'])) {
        $pass = $_COOKIE['pass'];
    } else {
        $pass = sha1($pass);
    }
    $postUser = $user->getUser($pseudo, $pass);
    if(!$postUser){
        throw new Exception('Vérifier vos identifiant');
    } 
    else {
        $posts = $postManager->getAllPosts();
        $descBlog = $blogManager->getBlog();
        foreach ($posts as $data)
        {
            $counter[$data['id']] = $commentManager->matchReportComments($data['id']);
        }
        
        session_start();
        $_SESSION['id'] = $postUser['id'];
        $_SESSION['name'] = $postUser['name'];
        $_SESSION['firstname'] = $postUser['firstname'];
    }
    if ($postUser['profile'] === 'admin') {
        require 'view/backend/listPostsAdmin.php';
    }
    else {
        require 'view/frontend/listPostsView.php';
    }
}

# 13. AJOUT D'UNE COOKIE SI L'OPTION SESSION ILLIMITÉE EST ACTIVÉE
function addCookie($pseudo, $pass)
 {
    $user = new Writer\Blog\Model\UserManager();
    $pass = sha1($pass);
    $postUser = $user->getUser($pseudo, $pass);
    if(!$postUser){
        throw new Exception('Vérifier vos identifiant');
    } 
    else {
        
        setcookie('pseudo', $postUser['pseudo'], time() + 365*24*3600, null, null, false, true);
        setcookie('pass',  $postUser['pass'], time() + 365*24*3600, null, null, false, true);
               
    }
 }

# 14. AFFICHAGE DU FORMULAIRE DE MISE À JOUR D'UN COMPTE ADMIN
function getUpdateUser($id)
{
    $user = new Writer\Blog\Model\UserManager;
    $blogManager = new Writer\Blog\Model\BlogManager;
    
    $infosUser = $user->getUserUpdate($id);
    $descBlog = $blogManager->getBlog();
 
    
    require_once 'view/backend/registration.php';
    
}

# 15. MISE À JOUR D'UN COMPTE ADMIN
function updateUser($pseudo, $pass, $emal, $profile, $name, $firstname, $id)
{
    $updateUser = new Writer\Blog\Model\UserManager;
    $postManager = new Writer\Blog\Model\PostManager();
    $blogManager = new Writer\Blog\Model\BlogManager;
    $commentManager = new \Writer\Blog\Model\CommentManager();
    
    $descBlog = $blogManager->getBlog();
    
    if (empty($pseudo) || empty($pass) || empty($emal) || empty($profile) || empty($name) || empty($firstname) || empty($id)) {
        throw new Exception('Imposible de mettre à jour votre compte car tous les champs sont obligatoires');
    }
    else {
         $pass = sha1($pass);
         $affectedLines = $updateUser->updateUser($pseudo, $pass, $emal, $profile, $name, $firstname, $id);
    }
    
    if ($affectedLines === FALSE) {
        throw new Exception('Imposible de mette à jour votre compte');
    }
    else {
        $postUser = $updateUser->getUser($pseudo, $pass);
        if (!$postUser){
            throw new Exception('Vérifier vos identifiant');
        } 
        else {
            session_start();
            $_SESSION['id'] = $postUser['id'];
            $_SESSION['name'] = $postUser['name'];
            $_SESSION['firstname'] = $postUser['firstname'];
        }
        if ($postUser['profile'] == 'admin'){
            $message = 'Votre compte a été mise à jour';
            $posts = $postManager->getAllPosts();
            foreach ($posts as $data)
            {
                $counter[$data['id']] = $commentManager->matchReportComments($data['id']);
            }
            
            require 'view/backend/listPostsAdmin.php';
        }
        else {
            $posts = $postManager->getPosts();
            require 'view/frontend/listPostsView.php';
        }
    }
}

# 16. AFFICHAGE DU FORMULAIRE DE CRÉATION DU BLOG : FONCTION UTILISÉE UNIQUEMENT À LA CRÉATION DU BLOG
function getFormBlog() 
{
    require 'view/backend/updateInfosBlog.php';
}

# 17. AJOUT DU BLOG : FONCTION UTILISÉE UNIQUEMENT À LA CRÉATION DU BLOG
function InsertBlog($title, $biography) 
{
   $insertBlog = new Writer\Blog\Model\BlogManager;
   $affectedLines = $insertBlog->addBlog($title, $biography);
   
   if ($affectedLines == FALSE) {
       
       throw new Exception('Imposible d\'ajouter les infos du blog');
   }
   else {
       echo 'ok';
   }
}

# 18. AFFICHAGE DU FORMULAIE DE MISE À JOUR DES INFOS DU BLOG
function GetFormUpdateBlog($idBlog)
{
     $blog = new Writer\Blog\Model\BlogManager;
     
     $descBlog = $blog->getBlog();
     $infosBlog = $blog->GetFormUpdateBlog($idBlog);
     
     require('view/backend/updateInfosBlog.php');
 } 

# 19. MISE À JOUR DES INFOS DU BLOG
 function updateBlog($title, $biography, $idBlog)
 {
     $updateBlog = new Writer\Blog\Model\BlogManager;
     $postManager = new Writer\Blog\Model\PostManager;
     $blog = new Writer\Blog\Model\BlogManager;
     $commentManager = new \Writer\Blog\Model\CommentManager();
     
     $descBlog = $blog->getBlog();
     if (empty($title) || empty($biography) || empty($idBlog))
     {
        throw new Exception('Imposible de mettre à jour les informations du blog car tous les champs sont obligatoires');
         
     }
    else {
         $affectedLines = $updateBlog->updateBlog($title, $biography, $idBlog);
     }
     
     if ($affectedLines == FALSE) {
         
         throw new Exception('Impossible de mette à jour les infos sur le blog');
         
     } else {
         
         $posts = $postManager->getAllPosts();
         $descBlog = $blog->getBlog();
         foreach ($posts as $data)
         {
            $counter[$data['id']] = $commentManager->matchReportComments($data['id']);
         }
         $message = 'Les infomations du blog sont mis à jour';
         require 'view/backend/listPostsAdmin.php';
     }
            
 }
 
 # 20. DECOONXION DE L'ESPACE ADMIN
 function disconnect()
 {
    
    setcookie('pseudo', '');
    setcookie('pass', '');
    session_start();
    session_destroy();
    
    $postManager = new Writer\Blog\Model\PostManager();
    $blog = new Writer\Blog\Model\BlogManager;
    $posts = $postManager->getPosts();
    $infosBlog = $blog->getBlog();
    
    require('view/frontend/listPostsView.php');
    
 }
 
# 21. VALIDATION D'UN COMMENTAIRE APRÈS SON SIGNALEMENT 
function validateComment ($commentId)
{
    $postManager = new Writer\Blog\Model\PostManager();
    $commentManager = new Writer\Blog\Model\CommentManager();
    $blogManager = new Writer\Blog\Model\BlogManager();
    
    $affectedLines = $commentManager->validateComment($commentId);
    $post = $postManager->getPost($_GET['idPost']);
    $comments = $commentManager->getCommentsByStatus($_GET['idPost']);
    $counter = $commentManager->matchComments($_GET['idPost']);
    $descBlog = $blogManager->getBlog();
    
    if ($affectedLines === false) {
        
      throw new Exception ('Impossible de valider ce commentaire');
    }
    else {
        
        require('view/backend/postView.php');
    } 
    
}

