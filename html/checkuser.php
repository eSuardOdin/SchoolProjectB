<?php
session_start();
require 'connexion.php';
$query = "SELECT * FROM Utilisateurs WHERE login_utilisateur='" .
	$_POST['login_utilisateur'] .
	"' AND pwd_utilisateur='" .
	$_POST['pwd_utilisateur'] .
	"';";
$result = $connexion->query($query);
$value = $result->fetch(PDO::FETCH_ASSOC);
//print_r($value);
if(!empty($value))
{
	session_unset();
	$_SESSION['id_utilisateur']=$value['id_utilisateur'];
	$_SESSION['login_utilisateur']=$value['login_utilisateur'];
	$_SESSION['nom_utilisateur']=$value['nom_utilisateur'];
	$_SESSION['prénom_utilisateur']=$value['prénom_utilisateur'];
	header('Location: index.php');exit;
}
else
{
	session_unset();
	$_SESSION['connect_err']="Mauvaise authentification";
	header('Location: login.php');exit;
}

?>
