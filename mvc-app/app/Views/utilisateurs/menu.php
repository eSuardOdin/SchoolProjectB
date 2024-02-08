
<!--<pre>
 <?= print_r($_SESSION['logged_user'])?> 
</pre>
-->

<!-- NAVBAR DES ROLES -->
<?php
// Si l'utilisateur est élève
    if($_SESSION['logged_user']['role'] === 'élève')
    {
        // echo APPPATH . 'Views/utilisateurs/élève/navbar.php';
        // include_once(APPPATH . 'Views/utilisateurs/élève/navbar.php');
        echo '
        <table>
            <tr>
                <td><a href="/">Menu</a></td>
                <td><a href="/planning">Planning</a></td>
            </tr>
        </table>
        ';
    }
// Si l'utilisateur est directeur
    elseif($_SESSION['logged_user']['role'] === 'directeur')
    {
        echo '
        <table>
            <tr>
                <td><a href="">Menu</a></td>
                <td><a href="">Départements</a></td>
                <td><a href="">Professeurs</a></td>
            </tr>
        </table>
        ';
    }
// Si l'utilisateur est professeur
    elseif($_SESSION['logged_user']['role'] === 'professeur')
    {
        echo '
        <table>
            <tr>
                <td><a href="">Menu</a></td>
                <td><a href="/planning">Planning</a></td>
                <td><a href="">Examens</a></td> ';

        // Si le professeur est chef
        if(isset($_SESSION['logged_user']['chef']))
        {
            echo '
            <td><a href="">Professeurs</a></td>
            <td><a href="">Elèves</a></td>
            <td><a href="/cours">Cours</a></td>
            ';
        }
        echo '
            </tr>
        </table>
        ';
    }
?>

<!-- Body du menu (infos diverses) -->
<h2>Bienvenue <?= $_SESSION['logged_user']['user_data']->prénom_utilisateur?> <?= $_SESSION['logged_user']['user_data']->nom_utilisateur?></h2>
<?php if(isset($_SESSION['logged_user']['chef'])) :?>
    <p>
        <u>Chef du département <?= $_SESSION['logged_user']['chef']->nom_département ?></u>
    </p>


<?php elseif(isset($_SESSION['logged_user']['pole'])) :?>
    <p>
        Rôle : Directeur du pôle <?= $_SESSION['logged_user']['pole']->nom_pôle ?></u>
    </p>
<?php else :?>
    <p>
        Rôle : <?= $_SESSION['logged_user']['role']?>
    </p>
<?php endif;?>
<br/><br/>
<form method="post" action="/logout">   
    <input type="submit" value="Déconnexion"/>
</form>
