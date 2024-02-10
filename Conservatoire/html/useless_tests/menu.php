<?php
session_start();
?>
<!DOCTYPE html> 
<html> 
  <head> 
    <title>PHP</title> 
  </head> 
  <body> 
        <h1> 
            <?php 
                echo "Bienvenue " . $_SESSION['prénom_utilisateur'] . " " . $_SESSION['nom_utilisateur'];
            ?> 
        </h1>
        <form action="deconnexion.php" method="post">
            <button type="submit">Se deconnecter</button>
        </form>
  </body> 
</html>
