<?php 
if(isset($_SESSION['user_data']['élève']['demande']))
{

    echo '
    <h1>Inscription</h1>
    <p>Votre demande d\'inscription est bien en cours pour : ' . $_SESSION['user_data']['élève']['demande']['infos'] . '</p>
    <form method="post" action="/logout">
        <input type="submit" value="Déconnexion"/>
    </form>';
}