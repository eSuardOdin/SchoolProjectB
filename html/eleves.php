<?php
require 'connexion.php';
$query='SELECT U.id_utilisateur, U.nom_utilisateur, U.prénom_utilisateur, C.nom_cycle 
FROM (Utilisateurs AS U
      INNER JOIN Elèves AS E ON U.id_utilisateur = E.id_élève)
INNER JOIN (Cycles AS C 
            INNER JOIN Elèves_Cycles AS EC ON C.id_cycle = EC.id_cycle) 
ON E.id_élève = EC.id_élève;';

$result=$connexion->query($query);
$rows=$result->fetchAll(PDO::FETCH_ASSOC);

echo '
	<h1>Elèves</h1>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Cycle</th>
			</tr>
		</thead>
		<tbody>
';

foreach ($rows as $r) {
	echo '<tr>
			<td>' . $r['id_utilisateur'] . '</td>
			<td>' . $r['nom_utilisateur'] . '</td>
			<td>' . $r['prénom_utilisateur'] . '</td>
			<td>' . $r['nom_cycle'] . '</td>
		</tr>';
}
echo '</tbody></table>';

?>
