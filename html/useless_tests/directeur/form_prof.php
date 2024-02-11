<?php
echo '
<h1>Ajout de professeur</h1>
<form action="add_prof.php">
<label for="id_utilisateur">Id : </label>
<input name="id_utilisateur" type="number">

<label for="nom_utilisateur">Nom : </label>
<input name="nom_utilisateur" type="text">

<label for="prénom_utilisateur">Prénom : </label>
<input name="prénom_utilisateur" type="text">

<label for="login_utilisateur">Login : </label>
<input name="login_utilisateur" type="text">

<input type="submit" value="Ajouter">
</form>
'

?>