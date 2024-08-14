<?php
include("connexion.php");

function getArticles($id=null) {
    if (!empty($id)) {
        $sql = "SELECT * FROM Article WHERE id=?";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } else {
    $sql = "SELECT * FROM Article";
    $req = $GLOBALS["connexion"]->prepare($sql);
    $req->execute();
    return $req->fetchAll();
    }
}

function getClients($id=null) {
    if (!empty($id)) {
        $sql = "SELECT * FROM Client WHERE id=?";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } else {
    $sql = "SELECT * FROM Client";
    $req = $GLOBALS["connexion"]->prepare($sql);
    $req->execute();
    return $req->fetchAll();
    }
}

function getVentes($id=null) {
    if (!empty($id)) {
        $sql = "SELECT v.id, nom_article, nom, prenom, v.quantite, prix, date_vente 
                FROM Client AS c, Vente AS v, Article AS a 
                WHERE v.id_article=a.id AND v.id_client=c.id AND v.id=?";
        
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } else {
        $sql = "SELECT v.id, nom_article, nom, prenom, v.quantite, prix, date_vente 
                FROM Client AS c, Vente AS v, Article AS a 
                WHERE v.id_article=a.id AND v.id_client=c.id";
        
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}
