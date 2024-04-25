<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cycles = document.getElementById('cycles');
        cycles.addEventListener('change', () => {
            getMatières(cycles.value);
        });
    });
    

    function getMatières(x)
    {
        console.log('Get matière de cycle id : ' + x);
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "/show_matières?cycles="+x);
        xhttp.onload = function() {
            if(xhttp.status >=200 && xhttp.status < 300)
            {
                // La requête a réussi
                // const matières = JSON.parse(xhttp.responseText);
                console.log(xhttp.responseText);
            }
            else
            {
                console.log("La requête a échoué avec le statut " + xhttp.status);
            }
        };
        xhttp.send();
    }
</script>

<form method="post" action="/cours">
    <input type="submit" value="Retour"/>
</form>
<form method="post" action="/cours/add_matière/traitement">
    <select id="cycles">
    <?php
    // Session
    $session = session();
    foreach($session->get('cycles') as $c)
    {
        echo '<option value="' . $c[0] . '">' . $c[1] . '</option>'; 
    }
    ?>
    </select>
    <label for="matière"></label>
    <label for="jour_créneau">Jour : </label>
    <select id="jour_créneau" name="jour_créneau" type="select">
        <option value="Lundi">Lundi</option>
        <option value="Mardi">Mardi</option>
        <option value="Mercredi">Mercredi</option>
        <option value="Jeudi">Jeudi</option>
        <option value="Vendredi">Vendredi</option>
    </select>
    <!-- <button id='show'/> -->
    <br/>
    <!-- <label for="id_cycle">Cycle de la matière: </label>
    <select id="id_cycle" name="id_cycle"> -->
<?php
$session->remove('cycles');

?>
    