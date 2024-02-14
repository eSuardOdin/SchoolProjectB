<?php 
if(isset($_SESSION['départements']))
{
    // echo '<pre>';
    // echo print_r($_SESSION);
    // echo '</pre>';
    echo '
    <h1>Inscription</h1>
    <p>Veuillez choisir un département : </p>
    <form method="post" action="/inscription/cycles">
    ';
    foreach($_SESSION['départements'] as $dep)
    {
        echo '
        <input type="radio" id="' . $dep->get_nom_departement() .'" value="'. $dep->get_id_departement() . '" name="dep" checked/>
        <label for="' . $dep->get_nom_departement() . '">' . $dep->get_nom_departement() . '</label>
        ';
    }
    echo '<input type="submit" value="Choisir"/></form>';
}

