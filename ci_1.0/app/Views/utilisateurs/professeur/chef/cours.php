<h1>Menu cours chef</h1>
<br/>
<br/>
<?php
echo '
    <form method="post" action="/cours/add_matière">
    <input type="submit" value="Ajouter une matière"/></form>';

foreach ($_SESSION['matières'] as $cycle => $matières) {
    echo '<h2>' . $cycle . ':</h2>';
        

    foreach ($matières as $matière) {
        echo '<p>  - ' . $matière->nom_matière . '</p>';
    }
    echo '<br/><br/>';
}

$session = session();
// Nettoyage de la session
$session->remove('matières');