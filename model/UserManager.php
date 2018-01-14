<?php

namespace Writer\Blog\Model;

require_once 'Manager.php';

class UserManager extends Manager
{
    public function createUser($pseudo, $pass, $email, $profile, $name, $firstname)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users (pseudo, pass, email, datecreate, dateupdate, profile, name, firstname) VALUES (?, ?, ?, NOW(), NOW(), ?, ?, ?)');
        $affectedLines = $req->execute(array ($pseudo, $pass, $email, $profile, $name, $firstname));
        
        return $affectedLines;
    }
    
    # 1. CONNEXION A L'ESPACE ADMIN
    public function getUser($pseudo, $pass)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, pass, email, DATE_FORMAT(datecreate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, profile, name, firstname, biography FROM users WHERE pseudo like ? AND pass LIKE ?');
        $req->execute(array($pseudo, $pass));
        $post = $req->fetch();

        return $post;
    }
    
    # 2. RECUPERATION COMPTE USER POUR MISE AJOUR
    public function getUserUpdate($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, pass, email, DATE_FORMAT(datecreate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, profile, name, firstname, biography FROM users WHERE id = ?');
        $req->execute(array($id));
        $post = $req->fetch();

        return $post;
    }
    
    # 3. MISE A JOUR COMPTE USER
    public function updateUser($pseudo, $pass, $emal, $profile, $name, $firstname, $id)
    {
        
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE users SET pseudo = ?, pass = ?, email = ?, profile = ?, name = ?, firstname = ?, dateupdate = NOW() WHERE id = ?');
        $affectedLines = $req->execute(array ($pseudo, $pass, $emal, $profile, $name, $firstname, $id));
        
        return $affectedLines;
           
    }
    
}
