<?php
if(isset($_SESSION['cycles']))
{
    

    echo '
    <h1>Inscription</h1>
    <p>Veuillez choisir un cycle : </p>
    <form method="post" action="/inscription/validation">
    ';
    foreach($_SESSION['cycles'] as $cycle)
    {
        if($cycle->get_places_cycle() > 0)
        {
            echo '
            <input type="radio" id="' . $cycle->get_id_cycle() .'" value="'. $cycle->get_id_cycle() . '" name="cycle" checked/>
            <label for="' . $cycle->get_id_cycle() . '">' . $cycle->get_nom_cycle() . ' ( ' 
            . $cycle->get_places_cycle() . ' places restantes)</label>
            <br/>';
        }
    }
    echo '<input type="submit" value="Choisir"/></form>';
}