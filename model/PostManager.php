<?php

namespace Writer\Blog\Model;

require_once 'Manager.php';

class PostManager extends Manager
{
    # 1. RÉCUPÉRATION DE TOUS LES POSTS
    public function getPosts() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 20');
        
        return $req;
    }

    # 1.1 RÉCUPÉRATION DE TOUS LES POSTS, EXEXUCTION DE LA REQUÊTE ET RETURN DE TOUTES LES DONNÉES
    public function getAllPosts() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 20');
        $posts = $req->fetchAll();
        return $posts;
        $posts->closeCursor();
    }
    
    # 2. RÉCUPÉRATION D'UN POST
    public function getPost($postId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
    
    # 3. CRÉATION D'UN POST
    public function createPost($title, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts (title, content, creation_date) VALUES (?, ?, NOW())');
        $affectedLines = $req->execute(array ($title, $content));
        
        return $affectedLines;
    }
    
    # 4. MISE A JOUR S'UN POST
    public function updatePost($title, $content, $id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $affectedLines = $req->execute(array ($title, $content, $id));
        
        return $affectedLines;
    }
    
    # 5. SUPPRESSION D'UN POST
    public function deletePost($id)
    {
        
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $affectedLines = $req->execute(array($id));
    }
}
