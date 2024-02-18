<?php
if(isset($_SESSION['demandes']))
{
    echo '<h1>Demandes d\'inscription</h1>';
    $nbDemandes = 0;
    $print = "";
    foreach($_SESSION['demandes'] as $demande)
    {
        $print .= '<u><h3>' . $demande['nom_cycle'] . ' ('. $demande['places_restantes'] . ' places restantes)</h3></u>';
        foreach($demande['élèves'] as $eleve)
        {
            $nbDemandes++;
            $print .= "\t- " . $eleve['prénom'] . ' ' . $eleve['nom'] . ' (' .$eleve['instrument'] . ')<br/>';
            $print .= '<form method="post" action="/accepter_inscription"><input type="hidden" value="'.$eleve['id'].'" name="id"/><input type="submit" value="Accepter"/></form>';
            $print .= '<form method="post" action="/refuser_inscription"><input type="hidden" value="'.$eleve['id'].'" name="id"/><input type="submit" value="Refuser"/></form>';
        }
    }
    echo '<p>Il y a ' . $nbDemandes . ' demandes à traiter.';
    echo $print;
}