<script>
    // Pour rendre dynamique l'affichage des instruments
    function getInstruments()
    {
        var famille = document.getElementById('famille_instrument').value;
        var test = document.getElementById('test');
        var req = new XMLHttpRequest();
        req.open("POST", "/inscription/get_instruments", true);
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        req.onreadystatechange = () => {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    var instrumentSelect = document.getElementById("instrument");
                    instrumentSelect.innerHTML = req.responseText;
                } else {
                    console.error("Une erreur s'est produite lors de l'envoi de la requête.");
                }
            }
        }
        req.send("famille_instrument="+famille );
    }
</script>
<body onload="getInstruments()">
    <form method="post" action ="inscription/utilisateur">
        <label for="nom">Nom : </label>
        <input type="text" name="nom"/>
        <label for="prénom">Prénom : </label>
        <input type="text" name="prénom"/>
        <br/>
        <label for="famille_instrument">Famille de l'instrument pratiqué : </label>
        <select id="famille_instrument" onchange="getInstruments()">
        <?php
            if(isset($_SESSION['famille_instrument']))
            {
                foreach ($_SESSION['famille_instrument'] as $famille) {
                    echo '
                    <option value="' . $famille . '">' . $famille . '</option>
                    ';
                }
            }
        ?>
        </select>
        <select id="instrument">
        
        </select>

        
    </form>
    <?php
    if(isset($_SESSION['error']))
    {
        echo '<p>' . $_SESSION['error'] . '</p>';
    }
    ?>
</body>