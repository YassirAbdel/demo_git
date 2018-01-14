<?php

require_once ('model/PostManager.php');
require_once ('model/CommentManager.php');
require_once 'model/BlogManager.php';

# 1. AFFICHAGE DES POSTS
function listPosts()
{
    
    $postManager = new Writer\Blog\Model\PostManager();
    $blog = new Writer\Blog\Model\BlogManager();
    
    $posts = $postManager->getPosts();
    $infosBlog = $blog->getBlog();

    require('view/frontend/listPostsView.php');
}

# 2. AFFICHAGE D'UN POST, LE NOMBRE DES COMMENTAIES ET LEURS CONTENUS
function post($id)
{
    $postManager = new Writer\Blog\Model\PostManager();
    $commentManager = new \Writer\Blog\Model\CommentManager();
    $blog = new Writer\Blog\Model\BlogManager();
    
    $post = $postManager->getPost($id);
    $comments = $commentManager->getCommentsByDate($id);
    $counter = $commentManager->matchComments($id);
    $infosBlog = $blog->getBlog();

    require('view/frontend/postView.php');
}

# 3. AJOUT D'UN COMMENTAIRE
function addComment($postId, $author, $comment)
{
    $postManager = new Writer\Blog\Model\PostManager();
    $commentManager = new Writer\Blog\Model\CommentManager();
    $blog = new Writer\Blog\Model\BlogManager();
    
    $affectedLines = $commentManager->postComment($postId, $author, $comment);
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getCommentsByDate($_GET['id']);
    $counter = $commentManager->matchComments($_GET['id']);
    $infosBlog = $blog->getBlog();
    
    if ($affectedLines === false) {
        
      throw new Exception ('Impossible d\'ajouter le commentaire');
    }
    else {
        
        require('view/frontend/postView.php');
    }  
}

# 4. // FONCTION NON UTILISÉE = RÉCUPÉRATION DES INFOS D'UN COMMENTAIRE 
function getComment ($commentId) 
{
    $commentManager = new Writer\Blog\Model\CommentManager();
    $comment = $commentManager->getComment($commentId);
    
    require('view/frontend/commentChange.php');
}

# 5. SIGNALEMENT D'UN COMMENTAIRE
function addReport ($commentId)
{
    $postManager = new Writer\Blog\Model\PostManager();
    $commentManager = new Writer\Blog\Model\CommentManager();
    $blog = new Writer\Blog\Model\BlogManager();
    
    $affectedLines = $commentManager->addReport($commentId);
    $post = $postManager->getPost($_GET['idPost']);
    $comments = $commentManager->getCommentsByDate($_GET['idPost']);
    $counter = $commentManager->matchComments($_GET['idComment']);
    $infosBlog = $blog->getBlog();
    
    if ($affectedLines === false) {
        
      throw new Exception ('Impossible de signaler ce commentaire');
    }
    else {
        
        require('view/frontend/postView.php');
    } 
    
}


