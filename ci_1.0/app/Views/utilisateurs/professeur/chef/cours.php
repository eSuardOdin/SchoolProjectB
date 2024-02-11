<h1>Menu cours chef</h1>
<br/>
<br/>
<?php
foreach ($_SESSION['matières'] as $cycle => $matières) {
    echo '<h2>' . $cycle . ':</h2>';
    foreach ($matières as $matière) {
        echo '<p>  - ' . $matière->nom_matière . '</p>';
    }
    echo '<br/><br/>';
}