<script>

    function initForm()
    {
        document.getElementById("formulaire").addEventListener("submit", function(event) {
            // On empêche le submit au clic
            event.preventDefault();
            // On gère le submit par la fonction validation
            prePostValidation();
        });

        getInstruments();
    }

    // Pour rendre dynamique l'affichage des instruments
    function getInstruments()
    {
        var famille = document.getElementById('famille_instrument').value;
        var req = new XMLHttpRequest();
        req.open("POST", "/inscription/get_instruments", false);
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

    /**
     * Validation de formulaire pré post.
     * Je laisse la validation de nullité des champs
     * et de longueur max aux attributs html, gestion 
     * de l'égalité des pwd et check des spécial chars
     */
    function prePostValidation()
    {
        // Check password :
        if(!checkPassword())
        {
            alert("Les mots de passe ne correspondent pas !");
            return false;
        }
        // Check instrument: 
        if(!checkInstrument())
        {
            alert("Veuillez selectionner votre instrument !");
            return false;
        }
        if(!checkSpecialChars())
        {
            alert("Les caractères {}[]\<>#@+()'\"/ sont interdits");
            return false;
        }
        // var instr = document.getElementById('instrument').value;
        // alert(instr);
        // return false;
        // Ajax pour check le login
        var login = document.getElementById('login').value;
        var req = new XMLHttpRequest();
        req.open("POST", "/inscription/check_login", true);
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        req.onreadystatechange = () => {
            console.log("ReadyState : " + req.readyState);
            if(req.readyState == 4) {
                if (req.status == 200)
                {
                    if (req.responseText.substring(0,1) == '1') // Valeur de retour dans le controller php
                    {
                        alert(`Le pseudo ${login} existe déjà !`);
                        return false;
                    }
                    else {

                        // Ajout de l'id de l'instrument au form avant le submit
                        var form = document.getElementById('formulaire');
                        var input = document.createElement('input');
                        input.setAttribute('name', 'instrument_id');
                        input.setAttribute('value', document.getElementById('instrument').value);
                        input.setAttribute('type', "hidden")
                        form.appendChild(input);
                        
                        form.submit();
                    }
                }
                else {
                    console.log("Erreur de connexion.");
                }
            }
        }
        req.send("login="+login);
    }

    function checkPassword()
    {
        var pwd = document.getElementById('pwd');
        var pwdConf = document.getElementById('pwd_confirmation');
        return (pwd.value != "" && pwdConf.value != "" && pwdConf.value == pwd.value);
    }

    function checkInstrument()
    {
        var instrument = document.getElementById('instrument').value;
        return (instrument != "");
    }

    function checkSpecialChars()
    {
        var pwd = document.getElementById('pwd').value;
        var pwdConf = document.getElementById('pwd_confirmation').value;
        var nom = document.getElementById('nom').value;
        var prenom = document.getElementById('prénom').value;
        var login = document.getElementById('login').value;
        var reg = /.*[\{\}\[\]\\<>#@+\(\)\/"']+.*/;
        // Return false si au moins un match
        return !(reg.test(pwd) 
        || reg.test(pwdConf)
        || reg.test(nom)
        || reg.test(prenom)
        || reg.test(login));
    }
</script>

<!-- Ne marche pas encore
<head>
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/css/styles.css'); ?>">
</head> -->


<body onload="initForm()">
    <form method="post" id="formulaire" action ="inscription/utilisateur">
        <label for="nom">Nom : </label>
        <input type="text" name="nom" id="nom" maxlength="64" required="required"/>
        <label for="prénom">Prénom : </label>
        <input type="text" name="prénom" id="prénom" maxlength="64" required="required"/>
        
        <label for="login">Login utilisateur : </label>
        <input type="text" name="login" id="login" maxlength="128" required="required"/>
        <br/>
        <br/>
        <label for="pwd">Mot de passe : </label>
        <input type="password" name="pwd" id="pwd" maxlength="128" required="required"/>
        <label for="pwd_confirmation">Confirmation : </label>
        <input type="password" name="pwd_confirmation" id="pwd_confirmation" maxlength="128" required="required"/>
        <br/>
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
        <select id="instrument" required="required"></select>
        <br/>
        <input type="submit" value="S'inscrire"/>
    </form>
    <?php
    if(isset($_SESSION['error']))
    {
        echo '<p>' . $_SESSION['error'] . '</p>';
    }
    ?>
</body>