<?php
$dsn='mysql:host=localhost;dbname=db_conservatoireV3_1';
$username='root';
$password='E12alt%F4';

try {
	$connexion=new PDO($dsn, $username, $password);
} catch (PDOException $e) {
	echo 'Erreur de connexion : ' . $e->getMessage();
	die();
}

?>
