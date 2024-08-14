<?php
include("connexion.php");
include_once ("fonctions.php");

if (!empty($_POST["id_article"]) && 
    !empty($_POST["id_client"]) && 
    !empty($_POST["quantite"]) && 
    !empty($_POST["prix"] && 
    !empty($_POST['date_vente']))) 
{

    $article = getArticles($_POST["id_article"]);

    if (!empty($article) && is_array($article)) {
        if ($_POST["quantite"]>$article["quantite"]) {
            $_SESSION["message"]["text"] = "La quantité à vendre n'est pas disponible";
            $_SESSION["message"]["type"] = "danger";
        } else {
            $sql = "INSERT INTO Vente(id_article, id_client, quantite, prix, date_vente)
            VALUES(?, ?, ?, ?, ?)";
            $req = $connexion->prepare($sql);
            $req->execute(array(
                $_POST["id_article"],
                $_POST["id_client"],
                $_POST["quantite"],
                $_POST["prix"],
                $_POST['date_vente'],
            ));

            if ($req->rowCount() > 0) {

                $sql = "UPDATE Article SET quantite=quantite-? WHERE id=?";
                $req = $connexion->prepare($sql);
                $req->execute(array(
                    $_POST["quantite"],
                    $_POST["id_article"],
                ));

                if ($req->rowCount() != 0) {
                    $_SESSION["message"]["text"] = "Vente effectué avec succés";
                    $_SESSION["message"]["type"] = "success";
                } else {
                    $_SESSION["message"]["text"] = "Impossible de faire cette vente";
                    $_SESSION["message"]["type"] = "danger";
                }
                
            } else {
                $_SESSION["message"]["text"] = "Une erreur s'est produite lors de la vente";
                $_SESSION["message"]["type"] = "danger";
            } 
        }
    }

    
} else {
    $_SESSION["message"]["text"] = "Une information obligatoire non renseignée";
    $_SESSION["message"]["type"] = "warning";
}

header("Location: ../views/vente.php");