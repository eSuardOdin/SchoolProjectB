<form method="post" action="/cours">
    <input type="submit" value="Retour"/>
</form>
<form method="post" action="/cours/add_matière/traitement">
    <label for="nom_matière">Nom de la matière: </label>
    <input id="nom_matière" name="nom_matière" type="text" placeholder="Nom..." minlength="2" maxlength="128" required/>
    <br/>
    <label for="id_cycle">Cycle de la matière: </label>
    <select id="id_cycle" name="id_cycle">
<?php
// Get les cycles depuis la session
$session = session();
foreach($session->get('cycles') as $c)
{
    echo '<option value="' . $c[0] . '">' . $c[1] . '</option>'; 
}

// Nettoyage session
$session->remove('cycles');
?>
    </select>
    <br/>
    <label for="durée_matière"><i>(optionnel) </i>Durée en minutes</label>
    <input id="durée_matière" name="durée_matière" type="number" placeholder="0" min="0" max="180"/>
    <br/>
    <label for="max_élèves_matière"><i>(optionnel) </i>Nombre d'élèves max</label>
    <input id="max_élèves_matière" name="max_élèves_matière" type="number" placeholder="0" min="0" max="20"/>
    <br/>
    <input type="submit" value="Ajouter une matière"/>
</form>