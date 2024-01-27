<?php

require '../connexion.php';

$query='INSERT INTO Utilisateurs(
    id_utilisateur,
    nom_utilisateur,
    prénom_utilisateur,
    pwd_utilisateur,
    login_utilisateur) VALUES
    (
        \''.$_POST['id_utilisateur'] . '\',' .
        '\''.$_POST['nom_utilisateur'] . '\',' .
        '\''.$_POST['prénom_utilisateur'] . '\',' .
        '\'1234\',' .
        '\''.$_POST['login_utilisateur'] . '\');';
try{
    $res = $connexion->prepare($query);
    $res->execute();
} catch(PDOException $e)
{
    echo $e->getMessage();
}


?>