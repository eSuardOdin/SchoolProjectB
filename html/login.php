<?php
session_start();
require 'connexion.php';
/*if(!isset $errorConnection)
{
	echo '<h3>Erreur</h3>';
}*/

echo '
	<form action="checkuser.php" method="post">
		<input type="text" placeholder="Login" name="login_utilisateur">
		<input type="password" placeholder="Password" name="pwd_utilisateur">
		<button type="submit">Se connecter</button>
	</form>';
	if(isset($_SESSION['id_utilisateur'])) {
		echo 'Bienvenue ' . $_SESSION['nom_utilisateur'] . ' ' . $_SESSION['prenom_utilisateur'];
	}
	if(isset($_SESSION['connect_err'])) {
		echo $_SESSION['connect_err'];
	}
print_r($_SESSION);
?>
