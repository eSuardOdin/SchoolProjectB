<?php 
if(isset($_SESSION['demande']))
{

    echo '
    <h1>Inscription</h1>
    <p>Votre demande d\'inscription est bien en cours pour : ' . $_SESSION['demande'] . '</p>
    <form method="post" action="/logout">
        <input type="submit" value="Déconnexion"/>
    </form>';
}