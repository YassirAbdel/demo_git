<?php

namespace Writer\Blog\Model;

require_once 'Manager.php';

class CommentManager extends Manager
{
    
    # 1. RÉCUPÉRATION DE TOUS LES COMMENTAIRES D'UN POSTE CLASSES PAR DATE DE CRÉATION
    function getCommentsByDate($postId) 
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT post_id, id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, status FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

	# 2.  RÉCUPÉRATION DE TOUS LES COMMENTAIRES D'UN POSTE CLASSES PAR STAUS (NON VALIDÉ = 0 ; VALIDÉ = 1 ; SIGNALÉ = 2) 
    function getCommentsByStatus($postId) 
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT post_id, id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, status FROM comments WHERE post_id = ? ORDER BY status DESC');
        $comments->execute(array($postId));

        return $comments;
    }
    
    # 3. RÉCUPÉRAATION DU COMPTEUR DES COMMENTAIRES
    function matchComments($postId) 
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) AS counter FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $req->execute(array($postId));
        $match = $req->fetch();
        
        return $match;
    }

	# 4. AJOUT D'UN COMMENTAIRE
    function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments (post_id, author, comment, comment_date) VALUES (?, ?, ?, NOW())');
        $affectedLines = $req->execute(array($postId, $author, $comment));

        return $affectedLines;
    }
    
    # 5. RÉCUPÉRATION D'UN COMMENTAIRE
    function getComment($commentId) 
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $req->execute(array($commentId));
        $comment = $req->fetch();
                
        return $comment;
    }
    
    # 6. SUPPRESSION D'UN COMMENTAIRE
    function deleteComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $affectedLines = $req->execute(array($commentId));
        
        return $affectedLines;
    }
    
    # 7. CHANGEMENT DU STATUT D'UN COMMENTAIRES SIGNALÉ = 2 
    
    function addReport ($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET status = 2 WHERE id = ?');
        $affectedLines = $req->execute(array($commentId));
        
        return $affectedLines;
    }
    
    # 8. CHANGEMENT DU STATUT D'UN COMMENTAIRE VALIDÉ = 1 
    function validateComment ($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET status = 1 WHERE id = ?');
        $affectedLines = $req->execute(array($commentId));
        
        return $affectedLines;
    }
    
    # 9. COMPTEUR DES COMMENTAIES SIGNALÉS
    function matchReportComments($postId) 
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) AS counter FROM comments WHERE post_id = ? and status = 2');
        $req->execute(array($postId));
        $match = $req->fetch();
        
        return $match;
    }
}
