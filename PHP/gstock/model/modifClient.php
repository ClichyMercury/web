<?php
include("connexion.php");

if (!empty($_POST["nom"]) && 
    !empty($_POST["prenom"]) && 
    !empty($_POST["telephone"]) && 
    !empty($_POST["adresse"]) && 
    !empty($_POST["id"])) 
{
    $sql = "UPDATE Client SET nom=?, adresse=?, telephone=?, adresse=? 
             WHERE id=?";
    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST["nom"],
        $_POST["adresse"],
        $_POST["telephone"],
        $_POST["adresse"],
        $_POST["id"],
    ));

    if ($req->rowCount() > 0) {
        $_SESSION["message"]["text"] = "Client modifié avec succés";
        $_SESSION["message"]["type"] = "success";
    } else {
        $_SESSION["message"]["text"] = "Rien n'a été modifié";
        $_SESSION["message"]["type"] = "warning";
    }
} else {
    $_SESSION["message"]["text"] = "Une information obligatoire non renseignée";
    $_SESSION["message"]["type"] = "danger";
}

header("Location: ../views/client.php");