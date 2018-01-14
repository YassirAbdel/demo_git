<?php

namespace Writer\Blog\Model;

require_once 'Manager.php';

class BlogManager extends Manager 
{
    # 1. AJOUT DES INFOS DU BLOG
    public function addBlog($title, $biography)
    {
        echo $title . ' ' . $biography;
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO presentation (title, biography) VALUES (?, ?)');
        $affectedLines = $req->execute(array($title, $biography));
        
        return $affectedLines;
    }
    
    # 2. RÉCUPÉRATION DES INFOS DU BLOG
    public function getBlog() {
        
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, biography FROM presentation ORDER BY id LIMIT 0, 1');
        
        return $req;
    }
    
    # 3. RÉCUPÉRATION DES INFOS DU BLOG, RECHERCHE PAR SON ID
    public function GetFormUpdateBlog($idBlog)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, biography FROM presentation WHERE id = ?');
        $req->execute(array($idBlog));
        $post = $req->fetch();
        
        return $post;
    }
    
    # 4. MISE A JOUR DES INFOS DU BLOG
    public function updateBlog($title, $biography, $idBlog)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE presentation SET title = ?, biography = ? WHERE id = ?');
        $affectedLines = $req->execute(array($title, $biography, $idBlog));
        
        return $affectedLines;
    }
}

