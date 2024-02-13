<?php 
if(isset($_SESSION['départements']))
{
    echo '
    <h1>Inscription</h1>
    <p>Veuillez choisir un département : </p>
    <form method="post" action="/inscription/département">
    ';
    foreach($_SESSION['départements'] as $dep)
    {
        echo '
        <input type="radio" id="' . $dep['nom_département'] .'" value="'. $dep["id_département"] . '" name="dep" checked/>
        <label for="' . $dep['nom_département'] . '">' . $dep['nom_département'] . '</label>
        ';
    }
    echo '<input type="submit" value="Choisir"/></form>';
}

