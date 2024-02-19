<?php 
if(isset($_SESSION['départements']))
{
    // echo '<pre>';
    // echo print_r($_SESSION);
    // echo '</pre>';
    echo '
    <h1>Inscription</h1>
    <p>Veuillez choisir un département où votre instrument est enseigné : </p>
    <form method="post" action="/inscription/cycles">
    ';
    foreach($_SESSION['départements'] as $dep)
    {
        echo '
        <input type="radio" id="' . $dep['nom_département'] .'" value="'. $dep['id_département'] . '" name="dep" checked/>
        <label for="' . $dep['nom_département'] . '">' . $dep['nom_département'] . '</label>
        ';
    }
    echo '<input type="submit" value="Choisir"/></form>';
}

