<?php
require 'connexion.php';
$query = 'SELECT id_utilisateur, nom_utilisateur, prénom_utilisateur FROM Utilisateurs 
INNER JOIN Professeurs ON id_utilisateur = id_professeur;';
$result = $connexion->query($query);
$rows = $result->fetchAll(PDO::FETCH_ASSOC);

echo '
	<h1>Professeurs</h1>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Nom</th>
				<th>Prénom</th>
			</tr>
		</thead>
		<tbody>
';

foreach ($rows as $r) {
	echo '<tr>
			<td>' . $r['id_utilisateur'] . '</td>
			<td>' . $r['nom_utilisateur'] . '</td>
			<td>' . $r['prénom_utilisateur'] . '</td>
		</tr>';
}
echo '</tbody></table>';





?>
