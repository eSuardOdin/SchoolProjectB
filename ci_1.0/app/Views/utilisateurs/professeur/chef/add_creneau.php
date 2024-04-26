<script>
    // On lance la recherche de matières liées au cycle
    document.addEventListener('DOMContentLoaded', async function() {
        // Au changement de cycle, on MAJ les matières
        const cycles = document.getElementById('cycles');
        const matière = document.getElementById('matière');
        await getMatières(cycles.value);
        // Debug
        console.log("value : " + matière.value);
        console.log("durée : " + matière.value.substring(matière.value.indexOf('-')+1));
        getHoraires(matière.value.substring(matière.value.indexOf('-')+1));
        
        cycles.addEventListener('change', () => {
            getMatières(cycles.value);
        });
        matière.addEventListener('change', () => {
            console.log("durée : " + matière.value.substring(matière.value.indexOf('-')+1));
            getHoraires(matière.value.substring(matière.value.indexOf('-')+1));
        });
    });
    

    // Mise a jour des options du select des matières
    async function getMatières(id_cycle)
    {
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "/show_matières?cycles="+id_cycle);
        xhttp.onload = function() {
            if(xhttp.status >=200 && xhttp.status < 300)
            {
                // La requête a réussi
                const res = xhttp.responseText.substring(0, xhttp.responseText.indexOf('<')-1);
                const matières = JSON.parse(res);
                var select_matières = document.getElementById('matière');
                // On vide les anciennes matières
                select_matières.innerHTML = null;
                // On créé le choix null
                var el = document.createElement('option');
                el.value = "-0";
                el.innerText = "------------------------------";
                select_matières.appendChild(el);
                // On crée chaque option
                matières.forEach(element => {
                    var el = document.createElement('option');
                    // Id-temps d'une matière 
                    el.value = element.id_matière + "-" + element.durée_matière;
                    el.innerText = element.nom_matière;
                    select_matières.appendChild(el);
                });
            }
            else
            {
                console.log("La requête a échoué avec le statut " + xhttp.status);
            }
        };
        xhttp.send();
    }

    // Avoir le temps d'une matière et adapter le select des horaires
    // Ajout des valeurs de créneaux
    function getHoraires(durée)
    {
        const xhttp = new XMLHttpRequest();
        if(durée > 0 && durée != "----")
        {
            xhttp.open("GET", "/show_horaires?durée="+durée);
            xhttp.onload = function() {
                if(xhttp.status >=200 && xhttp.status < 300)
                {
                    // La requête a réussi
                    if(xhttp.status >=200 && xhttp.status < 300)
                    {
                        // Get les horaires possibles en format JSON
                        var res = xhttp.responseText.substring(0, xhttp.responseText.indexOf("<") - 1);
                        var c = JSON.parse(res);
                        console.log(c);
                        const creneaux = document.getElementById('créneau');
                        // Les ajouter dans le select
                        c.forEach(element => {
                            var heure = element.heure;
                            var minutes = element.minutes;
                            minutes.forEach(m => {
                                var el = document.createElement("option");
                                el.value = heure + "h" + m;
                                // Append un 0 si heure pile
                                m = m == 0 ? "00" : m; // C'est degueulasse mais c'est js
                                el.innerText = heure + "h" + m;
                                creneaux.appendChild(el);
                            });
                        });
                    }
                }
                else
                {
                    console.log("La requête a échoué avec le statut " + xhttp.status);
                }
            };
            xhttp.send();
        }
        // Si choix de matière non valide, on vide les options de créneaux
        else
        {
            const creneaux = document.getElementById('créneau');
            creneaux.innerHTML = '<option value="-0">-----</option>';

        }
    }



    // Afficher les salles libres pour le créneau et valider ou non

</script>

<form method="post" action="/cours">
    <input type="submit" value="Retour"/>
</form>
<form method="post" action="/cours/add_matière/traitement">
    <select id="cycles">
    <?php
    // Session
    $session = session();
    // Select des cycles
    foreach($session->get('cycles') as $c)
    {
        echo '<option value="' . $c[0] . '">' . $c[1] . '</option>'; 
    }
    ?>
    </select>
    <label for="matière">Matière : </label>
    <!-- Select des matières -->
    <select id="matière" name="matière">
        <option value="-0">-----</option>
    </select>
    </br></br>
    <label for="jour_créneau">Jour : </label>
    <select id="jour_créneau" name="jour_créneau" type="select">
        <option value="Lundi">Lundi</option>
        <option value="Mardi">Mardi</option>
        <option value="Mercredi">Mercredi</option>
        <option value="Jeudi">Jeudi</option>
        <option value="Vendredi">Vendredi</option>
    </select>
    <label for="heure_créneau">Horaire de début : </label>
    <select id="créneau" name="créneau">
        <option value="-0">-----</option>
    </select>
    <!-- <button id='show'/> -->
    <br/>

    
    <!-- <label for="id_cycle">Cycle de la matière: </label>
    <select id="id_cycle" name="id_cycle"> -->
</form>
<?php
$session->remove('cycles');

?>
    