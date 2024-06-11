<?php
if(isset($_SESSION['demandes']))
{
    echo '<a href="/menu">Retour</a>';
    echo '<h1>Demandes d\'inscription</h1>';
    $nbDemandes = 0;
    $demandeDiplome = "true";
    $print = "";
    foreach($_SESSION['demandes'] as $demande)
    {
        $print .= '<u><h3>' . $demande['nom_cycle'];
        if(isset($demande['places_restantes']))
        {
            $demandeDiplome = "false";
            $print .=  ' ('. $demande['places_restantes'] . ' places restantes)';
        }
        $print .= '</h3></u>';
        foreach($demande['élèves'] as $eleve)
        {
            
            $nbDemandes++;
            $print .= "\t- " . $eleve['prénom'] . ' ' . $eleve['nom'] . ' (' .$eleve['instrument'] . ')<br/>';
            $print .= '<form method="post" action="/traiter_demande">';
            $print .= '<input type="hidden" value="'.$demandeDiplome .'" name="demande_diplome"/>';
            $print .= '<input type="hidden" value="'.$eleve['id'].'" name="id_élève"/>';
            $print .= '<input type="hidden" value="'.$demande['id_cycle'].'" name="id_cycle"/>';
            $print .= '<input type="submit" value="Accepter" name="action"/>';
            $print .= '<input type="submit" value="Refuser" name="action"/>';
            $print .= '</form>';
            
        }
    }
    echo '<p>Il y a ' . $nbDemandes . ' demandes à traiter.';
    echo $print;
}