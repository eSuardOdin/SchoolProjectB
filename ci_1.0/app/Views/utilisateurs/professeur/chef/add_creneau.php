<script>
    document.addEventListener('DOMContentLoaded', async function() {
        // ** --------- Variables du formulaire --------- **
        const cycles = document.getElementById('cycles');
        const matière = document.getElementById('matière');
        const heure_créneau = document.getElementById('heure_créneau');
        const jour_créneau = document.getElementById('jour_créneau');
        // On lance la recherche de matières liées au cycle
        await getMatières(cycles.value);
        getHoraires(matière.value.substring(matière.value.indexOf('-')+1));
        
        // ** --------- Event listeners --------- **
        // Obtenir la liste des matières liées au cycle
        cycles.addEventListener('change', () => {
            getMatières(cycles.value);
        });
        // Obtenir les créneaux de début possibles d'une matière (sans prise en compte de cours déjà pris)
        matière.addEventListener('change', () => {
            console.log("durée : " + matière.value.substring(matière.value.indexOf('-')+1));
            getHoraires(matière.value.substring(matière.value.indexOf('-')+1));
        });
        // Obtenir les profs disponibles (pour l'instant, tous les profs qui enseignent la matière)
        heure_créneau.addEventListener('change', () => {
            if(matière.value != '-0' && heure_créneau.value != '-0')
            {
                var val = matière.value;
                getProfesseurs(
                    val.substring(0, val.indexOf('-')), val.substring(val.indexOf('-')+1)
                );
            }
        });
        jour_créneau.addEventListener('change', () => {
            if(matière.value != '-0' && heure_créneau.value != '-0')
            {
                var val = matière.value;
                getProfesseurs(
                    val.substring(0, val.indexOf('-')), val.substring(val.indexOf('-')+1)
                );
            }
        });


        matière.addEventListener('change', () => {
            if(matière.value != '-0' && heure_créneau.value != '-0')
            {
                var val = matière.value;
                getProfesseurs(
                    val.substring(0, val.indexOf('-')), val.substring(val.indexOf('-')+1)
                );
            }
        });
    });
    

    /**
     * Mise à jour des options du select de la matière à ajouter (par rapport au cycle choisi)
     */
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

    /**
     * 
     * Affiche dans le formulaire les options des horaires possibles
     * d'un début de créneau.
     * Attention : Ne prend pas en compte les salles et professeurs libres
     */
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
                        const creneaux = document.getElementById('heure_créneau');
                        // Les ajouter dans le select
                        c.forEach(element => {
                            var heure = element.heure;
                            var minutes = element.minutes;
                            minutes.forEach(m => {
                                var el = document.createElement("option");
                                // Append un 0 si heure pile
                                m = m == 0 ? "00" : m; // C'est degueulasse mais c'est js
                                el.innerText = heure + "h" + m;
                                el.value = heure + ":" + m + ":00";
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
            const creneaux = document.getElementById('heure_créneau');
            creneaux.innerHTML = '<option value="-0">-----</option>';
        }
    }


    function getProfesseurs(id_matière, durée)
    {
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "/show_profs?id_matière="+id_matière+"&durée="+durée+"&h_début="+heure_créneau.value+"&jour="+jour_créneau.value);
        xhttp.onload = function() {
            if(xhttp.status >=200 && xhttp.status < 300)
            {
                // La requête a réussi
                var res = xhttp.responseText.substring(0, xhttp.responseText.indexOf("<") - 1);
                var c = JSON.parse(res);
                console.log(c);
            }
            else
            {
                console.log("La requête a échoué avec le statut " + xhttp.status);
            }
        };
        xhttp.send()
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
        <option value="0">Lundi</option>
        <option value="1">Mardi</option>
        <option value="2">Mercredi</option>
        <option value="3">Jeudi</option>
        <option value="4">Vendredi</option>
    </select>
    <label for="heure_créneau">Horaire de début : </label>
    <select id="heure_créneau" name="heure_créneau">
        <option value="-0">-----</option>
    </select>
    <br/>
</form>
<?php
$session->remove('cycles');

?>
    